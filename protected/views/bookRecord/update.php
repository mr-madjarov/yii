<?php
$this->breadcrumbs=array(
	'Book Records'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BookRecord','url'=>array('index')),
	array('label'=>'Create BookRecord','url'=>array('create')),
	array('label'=>'View BookRecord','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BookRecord','url'=>array('admin')),
	);
	?>

	<h1>Update information about <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>