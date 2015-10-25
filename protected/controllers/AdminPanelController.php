<?php
/**
 * Created by PhpStorm.
 * User: mrmadjarov
 * Date: 17.10.2015 г.
 * Time: 23:10
 */

class AdminPanelController extends Controller
{
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
     * ,
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'users' ),
                'users' => array( '*' ),
                //'roles'   => array( 'aAdminPanelIndex' ),
            ),
           /* array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),*/
        );
    }

    public function actionIndex()
    {
        $this->render( 'index' );
    }
    public function actionUsers()
    {
        $this->redirect( array( 'user/index' ) );
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}