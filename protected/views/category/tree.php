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

function listTree( $tree )
{
    echo "<ul>";
    foreach ( $tree as $key => $value ) {
            $name = $value['name'];
            echo "<li>". $name ."</li>";
        if( isset($value[ 'children' ])){
            listTree($value['children']);
        }

    }
    echo "</ul>";
}

selectListTree($tree);

function selectListTree( $tree )
{
    echo "<ul style='list-style-type:none'>";
    foreach ( $tree as $key => $value ) {
        $name = $value[ 'name' ];
        $id = $value[ 'id' ];
        echo "<li>" . "<input type='checkbox' value='" . $id . "' name='BookRecord[category_id]'/>"
                    . "&emsp;" . $name .
             "</li>";
        if ( isset( $value[ 'children' ] ) ) {
            selectListTree( $value[ 'children' ] );
        }

    }
    echo "</ul>";
}




?>

