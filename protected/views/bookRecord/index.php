<?php
$this->breadcrumbs = array(
    'Book Records',
);

$this->menu = array(
    array( 'label' => 'Add new contact', 'url' => array( 'create' ) ),
    array( 'label' => 'Manage contacts', 'url' => array( 'admin' ) ),
);
?>

<h1>PhoneBook </h1>


<?php $this->widget( 'bootstrap.widgets.TbGridView', array(
        'type'             => 'striped hover',
        'id'               => 'category-grid',
        'template'         => "{items}",
        'dataProvider'     => $dataProvider,
        'columns'          => array(
            'name',
            'phone',
            'email',
            'address',
            'category.name',
        ),
    )
);