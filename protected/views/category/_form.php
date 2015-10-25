<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>


<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>64)); ?>

    <br>
    <?php
            $userId = user()->id;
            $default_category = "'Default'";

            $criteria = new CDbCriteria;
            $criteria->condition = "created_by_user_id = $userId OR name = $default_category";
            $data = Category::model()->findAll( $criteria );


            $categoryTypes = CHtml::listData( $data, 'id', 'name' );
            echo t( 'Category' ) . '<span class="required" > *</span >' . '<br>' . $form->dropDownList( $model, 'parent_id',
            $categoryTypes, array( 'options' => array( '1' => array( 'selected' => true ) ) )
        ); ?>

<p class="help-block">For new category select default.</p>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>

