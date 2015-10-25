<?php /**
 * @var $this BookRecordController
 */
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
// start form widget
$form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'book-record-form',
        'enableAjaxValidation' => false,
    )
);
$userId = user()->id;?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary( $model ); ?>

<?php echo $form->textFieldRow( $model, 'name', array( 'class' => 'span5', 'maxlength' => 64 ) ); ?>

<?php echo $form->textFieldRow( $model, 'phone', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'email', array( 'class' => 'span5', 'maxlength' => 64 ) ); ?>

<?php echo $form->textFieldRow( $model, 'address', array( 'class' => 'span5', 'maxlength' => 100 ) ); ?>

<?php

    if ( $model->field != null ) {
        // data is save as JSON
        $old_data = $model->field;
        $cnt = 100;
        $ids = "Record_field" . $cnt;
        $new_data = json_decode( $old_data, true );
        array_pop( $new_data );

        foreach ( $new_data as $key => $value ) {
            echo "<label for='" . $ids . "'>" . $key . "</label>";
            echo "<input type='hidden'  name='labelVal[" . $cnt . "]'" . " value='" . $key . "'  />";
            echo "<input class='span5' type='text' name='Record[field][" . $cnt . "]'" . "maxlength='100' " . "id='Record_field" . $cnt . "' value=" . $value . " />";

            $cnt++;
        }

    }
?>
<br>
<?php
/*        function listCategory()
        {
            $userId = user()->id;
            $criteria = new CDbCriteria;
            $default_category = "'Default'";

            $criteria->condition = "created_by_user_id = $userId OR name = $default_category";
            $data = Category::model()->findAll( $criteria );

            $categoryTypes = CHtml::listData( $data, 'id', 'name' );


            $options[ "options" ] = array(
                'prompt' => 'Select a category',
            );


            echo t( 'Category' ) . '<br>' . $form->dropDownList( $model, 'category_id', $categoryTypes, array(

                        'prompt' => 'Select a category'
                    )
                );
        }
SELECT id, parent_id, name  FROM tbl_category WHERE created_by_user_id =" . $userId
*/

$tree = $this->getTree();
selectListTree( $tree );

//dump( $tree );exit;

function selectListTree( $tree )
{
    echo "<ul style='list-style-type:none'>";
    foreach ( $tree as $key => $value ) {
        $name = $value[ 'name' ];
        $id = $value[ 'id' ];
        echo "<li>" . "<input type='checkbox' value='" . $id . "' name='BookRecord[category_id]'/>" . "&emsp;" . $name . "</li>";
        if ( isset( $value[ 'children' ] ) ) {
            selectListTree( $value[ 'children' ] );
        }

    }
    echo "</ul>";
}



?>

&ensp;&emsp;&ensp;&emsp;&ensp;&emsp;&ensp;&emsp;&ensp;&emsp;&ensp;&emsp;&ensp;
<?php $this->widget( 'bootstrap.widgets.TbButton', array(
        'buttonType'  => 'button',
        'type'        => 'info',
        'label'       => 'Add new field',
        'htmlOptions' => array( 'onclick' => 'addInput()' ),
    )
); ?>

<div id="custom_field" class="custom-fields">

</div>

<div class="form-actions">
    <?php $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => $model->isNewRecord ? 'Create' : 'Save',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>



<script>
    var fields = 0;
    var mlabel = "mTitle";
    var cnt = 0;
    /**
     *  function addInput() add more input fields
     */
    function addInput() {
        mlabel = prompt( "Please enter title" );
        if ( mlabel ) {
            document.getElementById( 'custom_field' ).innerHTML += "<input class='span5' type='text' name='Record[field][" + fields + "]'" + "maxlength='100' " + "id='Record_field" + fields + "' />"

            fields = fields + 1;
        }
        addTitle();
    }
    /**
     * use prompt to get field title
     * and send value by labelVal[] array
     */
    function addTitle() {

        if ( mlabel ) {
            var ids = "Record_field" + cnt;
            var div = document.getElementById( 'Record_field' + cnt );
            div.insertAdjacentHTML( 'beforeBegin', "<label for='" + ids + "'>" + mlabel + "</label>" );
            document.getElementById( 'custom_field' ).innerHTML += "<input type='hidden'  name='labelVal[" + cnt + "]'" + " value='" + mlabel + "'  />";

            cnt = cnt + 1;
        }
    }
</script>


