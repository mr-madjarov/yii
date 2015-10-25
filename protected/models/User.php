<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 *
 * @property string     $id
 * @property string     $username
 * @property string     $password
 * @property integer    $active
 * @property string     $phone
 * @property string     $email
 * @property string     $address
 * @property string     $password_repeated
 *
 * The followings are the available model relations:
 * @property AuthItem[] $tblAuthItems
 */
class User extends CActiveRecord
{

    /**
     * The constant for indicating that the user is active (can login).
     */
    const ACTIVE = 1;

    /**
     * The constant for indicating that the user is inactive (cannot login).
     */
    const INACTIVE = 0;

    /**
     * @var string password confirmation field.
     */
    public $password_repeated;

    /**
     * @var string[] the RBAC roles of the current user.
     */
    public $roles;

    /**
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'username, password, password_repeated', 'required' ),
            array( 'active', 'numerical', 'integerOnly' => true ),
            array( 'username, password, password_repeated', 'length', 'max' => 100 ),
            array( 'phone, email', 'length', 'max' => 64 ),
            array( 'address', 'safe' ),
            array( 'phone', 'numerical' ),
            array( 'email', 'email' ),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, username, password, active, phone, email, address, password_repeated',
                'safe',
                'on' => 'search'
            ),
            array( 'password', 'compare', 'compareAttribute' => 'password_repeated' ),
            array( 'active', 'in', 'range' => array( User::ACTIVE, User::INACTIVE ) ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tblAuthItems' => array( self::MANY_MANY, 'AuthItem', '{{auth_assignment}}(userid, itemname)' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => 'ID',
            'username'          => 'Username',
            'password'          => 'Password',
            'active'            => 'Active',
            'phone'             => 'Phone',
            'email'             => 'Email',
            'address'           => 'Address',
            'password_repeated' => 'Repeat password',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare( 'id', $this->id, true );
        $criteria->compare( 'username', $this->username, true );
        $criteria->compare( 'password', $this->password, true );
        $criteria->compare( 'active', $this->active );
        $criteria->compare( 'phone', $this->phone, true );
        $criteria->compare( 'email', $this->email, true );
        $criteria->compare( 'address', $this->address, true );
        $criteria->compare( 'password_repeated', $this->password_repeated, true );

        return new CActiveDataProvider( $this, array(
                'criteria' => $criteria,
            )
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array(
            'withRelated' => array(
                'class' => 'ext.behaviors.wr.WithRelatedBehavior',
            ),
        );
    }

    /**
     * Overrides the CActiveRecord save() method in order to implement saving of related models.
     *
     * @param bool  $runValidation Whether to perform validation before saving the record.
     *                             If the validation fails, the record will not be saved to database.
     * @param array $attributes
     *
     * @throws Exception
     * @return bool Whether the saving was successful.
     */
    public function save( $runValidation = true, $attributes = null )
    {
        $transaction = $this->getDbConnection()->beginTransaction();
        try {
            // Save the model with the relations
            if ( $this->withRelated->save( $runValidation, $attributes ) ) {
                $transaction->commit();
                return true;
            }
            return false;
        } catch ( Exception $ex ) {
            $transaction->rollback();
            throw $ex;
        }
    }

    /**
     * @return bool
     */
    protected function beforeSave()
    {
        // Hash the password
        if ( !empty( $this->password ) ) {
            $ph = new PasswordHash( Yii::app()->params[ 'phpass' ][ 'iteration_count_log2' ],
                Yii::app()->params[ 'phpass' ][ 'portable_hashes' ]
            );
            $this->password = $ph->HashPassword( $this->password );
        } else {
            // The password is empty
            if ( !$this->isNewRecord ) {
                // Do not save (overwrite) the password to the database when updating
                unset( $this->password );
            }
        }

        return parent::beforeSave();
    }

    protected function afterSave()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Assign roles to the user
        // -------------------------------------------------------------------------------------------------------------
        if ( $this->isNewRecord ) { // We are executing the Create action
            // Assign the selected roles to the user
            if ( !empty( $this->roles ) ) {
                foreach ( $this->roles as $role ) {
                    Yii::app()->authManager->assign( $role, $this->id );
                }
            }
        } else { // We are executing the Update action
            // Revoke the current roles before assigning the new ones
            $assignedRoles = array_keys( Yii::app()->authManager->getRoles( $this->id ) );
            foreach ( $assignedRoles as $assignedRole ) {
                Yii::app()->authManager->revoke( $assignedRole, $this->id );
            }
            // Assign the selected roles to the user
            if ( !empty( $this->roles ) ) {
                foreach ( $this->roles as $role ) {
                    Yii::app()->authManager->assign( $role, $this->id );
                }
            }
        }
        // end of Assign roles to the user -----------------------------------------------------------------------------

        parent::afterSave();
    }

    /**
     *
     */
    protected function afterFind()
    {
        // Load the currently assigned roles into the model
        $this->roles = array_keys( Yii::app()->authManager->getRoles( $this->id ) );

        parent::afterFind();
    }
}
