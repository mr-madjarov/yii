<?php
$this->breadcrumbs=array(
	'Book Records'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'View all contacts','url'=>array('index')),
array('label'=>'Manage contacts','url'=>array('admin')),
);
?>

<h1>Add new contact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>