<?php
$this->breadcrumbs=array(
	'Book Records'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'View all contacts','url'=>array('index')),
	array('label'=>'Add new contact','url'=>array('create')),
	array('label'=>'View contact','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage contacts','url'=>array('admin')),
	);
	?>

	<h1>Update information about <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>