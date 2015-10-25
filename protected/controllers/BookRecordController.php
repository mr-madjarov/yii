<?php

class BookRecordController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'index', 'view' ),
                'users'   => array( '*' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'create', 'update' ),
                'users'   => array( '@' ),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array( 'admin', 'delete' ),
                'users'   => array( '@' ),
            ),
            array(
                'deny',  // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView( $id )
    {

        $this->render( 'view', array(
                'model' => $this->loadModel( $id ),
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new BookRecord;
        $userId = Yii::app()->user->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'BookRecord' ] ) ) {
            $model->created_by_user_id = $userId;
            if ( isset ( $_POST[ 'labelVal' ] ) && isset( $_POST[ 'Record' ] ) ) {
                //Таке values of user`s added input fields
                $fieldArray = $_POST[ 'Record' ][ 'field' ];
                //Take values of title of users`s added input fields
                $titledArray = $_POST[ 'labelVal' ];

                //match the arrays in one for serializing
                $concatArr = array_combine( $titledArray, $fieldArray );
                //add user_id in the end of the array
                array_push( $concatArr, $userId );

                $serial_field = CJSON::encode( $concatArr );
                //$serial_field = base64_encode( serialize( $concatArr ) );
                //save new fields in the model
                $model->field = $serial_field;

            }
            $model->attributes = $_POST[ 'BookRecord' ];
            if ( $model->save() ) {
                $this->redirect( array( 'view', 'id' => $model->id ) );
            }
        }

        $this->render( 'create', array(
                'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );
        $userId = Yii::app()->user->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'BookRecord' ] ) ) {


           if(isset ($_POST[ 'labelVal' ]) && isset( $_POST[ 'Record' ])) {
               //Take values of title of users`s added input fields
               $titledArray = $_POST[ 'labelVal' ];
               //Таке values of user`s added input fields
               $fieldArray = $_POST[ 'Record' ][ 'field' ];
               //match the arrays in one for serializing
               $concatArr = array_combine( $titledArray, $fieldArray );
               //add user_id in the end of the array
               array_push( $concatArr, $userId );

               $serial_field = CJSON::encode( $concatArr );
               //$serial_field = base64_encode( serialize( $concatArr ) );
               //save new fields in the model
               $model->field = $serial_field;
           }



            $model->attributes = $_POST[ 'BookRecord' ];
            if ( $model->save() ) {
                $this->redirect( array( 'view', 'id' => $model->id ) );
            }
        }

        $this->render( 'update', array(
                'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete( $id )
    {
        if ( Yii::app()->request->isPostRequest ) {
            // we only allow deletion via POST request
            $this->loadModel( $id )->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if ( !isset( $_GET[ 'ajax' ] ) ) {
                $this->redirect( isset( $_POST[ 'returnUrl' ] ) ? $_POST[ 'returnUrl' ] : array( 'admin' ) );
            }
        } else {
            throw new CHttpException( 400, 'Invalid request. Please do not repeat this request again.' );
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $userID = user()->id;
        $dataProvider = new CActiveDataProvider( 'BookRecord', [
                'criteria' => [
                    'condition' => "created_by_user_id ='$userID'"
                ]
            ]
        );
        $this->render( 'index', array(
                'dataProvider' => $dataProvider,
            )
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $userID = user()->id;
        $model = new BookRecord( 'search' );
        $model->unsetAttributes();  // clear any default values
        if ( isset( $_GET[ 'BookRecord' ] ) ) {
            $model->attributes = $_GET[ 'BookRecord' ];
        }

        $dataProvider = new CActiveDataProvider( 'BookRecord', [
                'criteria' => [
                    'condition' => "created_by_user_id ='$userID'"
                ]
            ]
        );

        $this->render( 'admin', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel( $id )
    {
        $model = BookRecord::model()->findByPk( $id );
        if ( $model === null ) {
            throw new CHttpException( 404, 'The requested page does not exist.' );
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'book-record-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }

    /**
     *
     * @return array
     */
    public function getTree(){
         $userId = user()->id;
         //SQL query to get all data for categories
         $arr = Yii::app(
         )->db->createCommand( "SELECT id, parent_id, name  FROM tbl_category WHERE created_by_user_id =" . $userId )
             ->queryAll();
         // dump( $arr );
         // function that create tree as arrays if node of tree has children function put key children
         function createTree( &$list, $parent )
         {
             $tree = array();
             foreach ( $parent as $k => $l ) {
                 if ( isset( $list[ $l[ 'id' ] ] ) ) {
                     $l[ 'children' ] = createTree( $list, $list[ $l[ 'id' ] ] );
                 }
                 $tree[ ] = $l;
             }
             return $tree;
         }

         $new = array();
         /*
          * Create  $new array to be used by
          * createTree();
          * get all parent_id`s as key which being the ID of the item
         */
         foreach ( $arr as $a ) {
             $new[ $a[ 'parent_id' ] ][ ] = $a;
         }
         /**
          * Create tree that will be rendered to the view
          */
         $tree = createTree( $new, $new[ '' ] );
         return $tree;
     }
}
