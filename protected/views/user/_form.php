<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
    'type' => 'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'well'
    )
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->passFieldRow( $model, 'password', array(), array( 'maxlength' => 100 ) );

    echo $form->passFieldRow( $model, 'password_repeated', array(
            'options' => array(
                'showGenerate' => false
            )
        ), array( 'maxlength' => 100 )
    );
    ?>

	<?php echo $form->toggleButtonRow( $model, 'active', array(
            'enabledLabel'  => t( 'Yes' ),
            'disabledLabel' => t( 'No' ),
            'disabledStyle' => 'danger',
            'enabledStyle'  => 'success'
        )
    ); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textAreaRow($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));

    $roles = array(
        'systemAdministrator' => t( 'Administrator' ),
        'user'             => t( 'User' ),

    );

    echo $form->checkBoxListRow( $model, 'roles', $roles, array(), array( 'separator' => '' ) );

    ?>



<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
