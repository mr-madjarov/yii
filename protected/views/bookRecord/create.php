<?php
$this->breadcrumbs=array(
	'Book Records'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BookRecord','url'=>array('index')),
array('label'=>'Manage BookRecord','url'=>array('admin')),
);
?>

<h1>Create BookRecord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>