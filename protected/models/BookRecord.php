<?php

/**
 * This is the model class for table "{{book_record}}".
 *
 * The followings are the available columns in table '{{book_record}}':
 *
 * @property string  $id
 * @property string  $name
 * @property integer $phone
 * @property string  $email
 * @property string  $address
 * @property string  $field
 * @property string  $created_by_user_id
 * @property string  $category_id
 *
 * The followings are the available model relations:
 * @property User    $createdByUser
 */
class BookRecord extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{book_record}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'name, phone, created_by_user_id', 'required' ),
            array( 'phone', 'numerical', 'integerOnly' => true ),
            array( 'name, email', 'length', 'max' => 64 ),
            array( 'address', 'length', 'max' => 100 ),
            array( 'field', 'length','max' => 1024 ),
            array( 'created_by_user_id, category_id', 'length', 'max' => 10 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, name, phone, email, address, field, created_by_user_id, category_id',
                'safe',
                'on' => 'search'
            ),
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
            'category' => array( self::BELONGS_TO, 'Category', 'category_id' ),
            'createdByUser' => array( self::BELONGS_TO, 'User', 'created_by_user_id' ),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                 => 'ID',
            'name'               => 'Name',
            'phone'              => 'Phone',
            'email'              => 'Email',
            'address'            => 'Address',
            'field'              => 'Field',
            'created_by_user_id' => 'Created By User',
            'category_id'        => 'Category',
            'category.name'        => 'Category',
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
        $userID = user()->id;

        $criteria->compare( 'id', $this->id, true );
        $criteria->compare( 'name', $this->name, true );
        $criteria->compare( 'phone', $this->phone );
        $criteria->compare( 'email', $this->email, true );
        $criteria->compare( 'address', $this->address, true );
        $criteria->compare( 'field', $this->field, true );
        $criteria->compare( 'created_by_user_id', $this->created_by_user_id, true );
        $criteria->compare( 'category_id', $this->category_id, true );
        //User can see only their own records
        $criteria->addCondition( ['condition' => "created_by_user_id ='$userID'"] );

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
     * @return BookRecord the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

   /* protected function beforeSave()
   // {
        // If is not set already
        if ( !empty( $this->created_by_user_id ) ) {
            $this->created_by_user_id = user()->id;
        }

        return parent::beforeSave();
    }
   */
    public function JSONtoArray( $json )
    {
       return CJSON::decode( $json, true );
    }
}
