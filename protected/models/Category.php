<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 *
 * @property string     $id
 * @property string     $name
 * @property string     $parent_id
 * @property string     $created_by_user_id
 *
 * The followings are the available model relations:
 * @property User       $createdByUser
 * @property Category   $parent
 * @property Category[] $categories
 */
class Category extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'name, created_by_user_id', 'required' ),
            array( 'name', 'length', 'max' => 64 ),
            array( 'parent_id, created_by_user_id', 'length', 'max' => 10 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, name, parent_id, created_by_user_id', 'safe', 'on' => 'search' ),
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
            'createdByUser' => array( self::BELONGS_TO, 'User', 'created_by_user_id' ),
            'parent'        => array( self::BELONGS_TO, 'Category', 'parent_id' ),
            'categories'    => array( self::HAS_MANY, 'Category', 'parent_id' ),
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
            'parent_id'          => 'Parent',
            'created_by_user_id' => 'Created By User',
            'parent.name' => 'Parent category',
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
        $criteria->compare( 'parent_id', $this->parent_id, true );
        $criteria->compare( 'created_by_user_id', $this->created_by_user_id, true );
        //User can see only their own records
        $criteria->addCondition( [ 'condition' => "created_by_user_id ='$userID'" ] );
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
     * @return Category the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    protected function beforeSave()
    {
        // If is not set already
        if ( empty( $this->created_by_user_id ) ) {
            $this->created_by_user_id = user()->id;
        }

        return parent::beforeSave();
    }


    public function  cat()
    {
        $criteria = new CDbCriteria;


        $criteria->compare( 'category_id', $this->category_id, true );
        return new CActiveDataProvider( $this, array(
                'criteria' => $criteria,
            )
        );

    }


}
