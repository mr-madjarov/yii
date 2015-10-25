<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php /*echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); */?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>64)); ?>

		<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>64)); ?>

		<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>100)); ?>

		<?php
        echo "<br>";
        $userId = user()->id;
        $criteria = new CDbCriteria;
        $default_category = "'Default'";

        $criteria->condition = "created_by_user_id = $userId OR name = $default_category";
        $data = Category::model()->findAll( $criteria );

        $categoryTypes = CHtml::listData( $data, 'id', 'name' );


        $options[ "options" ] = array(
            'prompt' => 'Select a category',
        );


        echo t( 'Category' ) . '<br>' . $form->dropDownList( $model, 'category_id', $categoryTypes, array(

                    'prompt' => 'Select a category'
                )
            );

        ?>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type'=>'primary',
    'label'=>'Search',
)); ?>
</div>

<?php $this->endWidget(); ?>
