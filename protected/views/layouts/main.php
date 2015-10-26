<?php /** @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"/>

    <title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
</head>
<body>
<div class="container" id="content">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="#"><?php echo CHtml::encode( Yii::app()->name ); ?></a>
                <?php $this->widget( 'zii.widgets.CMenu', array(
                        'items'       => array(
                            array( 'label' => t('Home'), 'url' => array( '/site/index' ) ),
                            array(
                                'label' => t('Contacts'),
                                'url' => array( '/bookRecord/index' ),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array(
                                'label' => t('Categories'),
                                'url' => array( '/category/tree' ),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array( 'label' => t('About' ), 'url' => array( '/site/page', 'view' => 'about' ) ),
                            array( 'label' => t( 'Contact us' ), 'url' => array( '/site/contact' ) ),
                            array(
                                'label'   => t('Login'),
                                'url'     => array( '/site/login' ),
                                'visible' => Yii::app()->user->isGuest
                            ),
                            array(
                                'label'   => 'Logout (' . Yii::app()->user->name . ')',
                                'url'     => array( '/site/logout' ),
                                'visible' => !Yii::app()->user->isGuest
                            )
                        ),
                        'htmlOptions' => array( 'class' => 'nav' )
                    )
                ); ?>
            </div>
        </div>
    </div>
    <?php echo $content; ?>
    <div class="clear"></div>
    <div id="footer">

        <?php echo date( 'Y-m-d H:i' ); ?>
    </div>
    <!-- footer -->
</div>
<!-- page -->
</body>
</html>
