<?php
$this->breadcrumbs = array(
    'Book Records',
);

$this->menu = array(
    array( 'label' => 'Create BookRecord', 'url' => array( 'create' ) ),
    array( 'label' => 'Manage BookRecord', 'url' => array( 'admin' ) ),
);
?>

<h1>Book Records</h1>

<?php $this->widget( 'bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView'     => '_view',
    )
); ?>
