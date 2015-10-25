<?php
$this->breadcrumbs = array(
    'Categories' => array( 'index' ),
    'Manage',
);

$this->menu = array(
    array( 'label' => 'List Category', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Category', 'url' => array( 'create' ) ),
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

<h1>Manage Categories</h1>

<?php echo CHtml::link( 'Advanced Search', '#', array( 'class' => 'search-button btn' ) ); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial( '_search', array(
            'model' => $model,
        )
    ); ?>
</div><!-- search-form -->

<?php $this->widget( 'bootstrap.widgets.TbGridView', array(
        'id'           => 'category-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            //'id',
            'name',
            //'parent_id',
            //'created_by_user_id',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    )
); ?>
