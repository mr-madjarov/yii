<?php
$this->breadcrumbs = array(
    'Book Records' => array( 'index' ),
    'Manage',
);

$this->menu = array(
    array( 'label' => 'List BookRecord', 'url' => array( 'index' ) ),
    array( 'label' => 'Create BookRecord', 'url' => array( 'create' ) ),
);
?>

<h1>Manage Book Records</h1>
<h3>For more information click on contact.</h3>

<?php $this->widget( 'bootstrap.widgets.TbGridView', array(
        'type'             => 'striped hover',
        'dataProvider'     => $dataProvider,
        'columns'          => array(
            'name',
            'phone',
            'email',
            'address',
            //'field',
            //'created_by_user_id',
            'category.name',
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
