<?php

class CategoryController extends Controller
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
                'actions' => array( 'index', 'view', 'tree' ),
                'users'   => array( '@' ),
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
     */
    public function actionView( $id )
    {
        $userId = user()->id;
        $categoryId = $id;

        $dataProvider = new CActiveDataProvider( 'BookRecord', [
                'criteria' => [
                    'condition' => "created_by_user_id ='$userId' AND category_id = '$categoryId'"
                ]
            ]
        );
        $this->render( 'view', array(
                'model' => $this->loadModel( $id ),
                'dataProvider' => $dataProvider,
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Category;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'Category' ] ) ) {
            $model->created_by_user_id = Yii::app()->user->id;
            $model->attributes = $_POST[ 'Category' ];
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
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'Category' ] ) ) {
            $model->attributes = $_POST[ 'Category' ];
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
        $userId = user()->id;
        $dataProvider = new CActiveDataProvider( 'Category', [
                'criteria' => [
                    'condition' => "created_by_user_id ='$userId'"
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
        $model = new Category( 'search' );
        $model->unsetAttributes();  // clear any default values
        if ( isset( $_GET[ 'Category' ] ) ) {
            $model->attributes = $_GET[ 'Category' ];
        }

        $this->render( 'admin', array(
                'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel( $id )
    {
        $model = Category::model()->findByPk( $id );
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
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'category-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }

    /**
     * Lists all models as tree view
     * use direct SQL query to get needed from model
     */
    public function actionTree(){
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
         * which has parent_id as key which being the ID of the item
        */
        foreach ( $arr as $a ) {
            $new[ $a[ 'parent_id' ] ][ ] = $a;
        }
        /**
         * Create tree that will render to the view
         */
        $tree = createTree( $new, $new[ '' ] );

        $this->render( 'tree', array( 'tree' => $tree ) );

    }
}
