<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
?>
<div class="page-header">
    <h1>Login
        <small>Please fill out the following form with your login credentials:</small>
    </h1>
</div>

<div class="form">
    <?php
    /** @var TbActiveForm $form */
    $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'login-form',
        'enableClientValidation' => true,
        'htmlOptions' => array( 'class' => 'well' ),
    ));
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php
        echo $form->textFieldRow( $model, 'username', array( 'class' => 'span3' ) );
        echo $form->passwordFieldRow( $model, 'password', array( 'class' => 'span3' ) );
        echo $form->checkboxRow( $model, 'rememberMe' );
        $this->widget( 'bootstrap.widgets.TbButton', array( 'buttonType' => 'submit', 'label' => 'Login' ) );
        $this->endWidget();
    ?>
</div><!-- form -->
