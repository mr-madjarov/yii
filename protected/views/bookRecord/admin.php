<?php
/**
 * @var $model BookRecord
 * @var $dataProvider CActiveDataProvider
 */
$this->breadcrumbs = array(
    'Book Records' => array( 'index' ),
    'Manage',
);

$this->menu = array(
    array( 'label' => 'View all contacts', 'url' => array( 'index' ) ),
    array( 'label' => 'Add new contact', 'url' => array( 'create' ) ),
);

Yii::app()->clientScript->registerScript( 'search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('category-grid', {
data: $(this).serialize()
});
return false;
});
"
);
?>
<h1>Manage PhoneBook Contacts</h1>
<h4>Click on row for more information about contact</h4>
<h4>Click on category name to see all contacts in that category</h4>
<?php echo CHtml::link( 'Advanced Search', '#', array( 'class' => 'search-button btn' ) ); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial( '_search', array(
            'model' => $model,
        )
    ); ?>
</div><!-- search-form -->
<?php


$this->widget( 'bootstrap.widgets.TbGridView', array(
        'type'             => 'striped hover',
        'id'               => 'category-grid',
        'template'         => "{items}",
        'dataProvider'     => $model->search(),
        'columns'          => array(
            'name',
            'phone',
            'email',
            'address',
            //'category.name',
                array(
                'name'  => 'category.name',
                //'header'      => 'Custom Header',
                //'htmlOptions' => array( 'width' => '20%' ),
                'type'  => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data[ "category" ]["name"]), array("category/view","id"=>$data->category_id))'
            ),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
        'selectableRows'   => true,
        'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl( 'view'
            ) . '&id="+$.fn.yiiGridView.getSelection(id);}',
    )
);
?>
