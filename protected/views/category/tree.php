<?php
/** @var CategoryController $tree */
//JavaScript that allows to check only one checkbox
Yii::app()->clientScript->registerScript( 'search', "
$('input:checkbox').on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var box = $(this);
  if (box.is(':checked')) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = 'input:checkbox[ name = \'' + box.attr('name') + '\' ]';
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop('checked', false);
    box.prop('checked', true);
  } else {
    box.prop('checked', false);
  }
});
"
);

$this->menu = array(
    array( 'label' => 'Create Category', 'url' => array( 'create' ) ),
    array( 'label' => 'Manage Category', 'url' => array( 'admin' ) ),
);

echo CHtml::tag( 'h2', array(), "Category tree view", "h2" );
echo CHtml::tag( 'h5', array(), "Click on category to see  contacts", "h5" );

$this->selectListTree($tree);


