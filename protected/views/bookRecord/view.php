<?php
$this->breadcrumbs = array(
    'Book Records' => array( 'index' ),
    $model->name,
);

$this->menu = array(
    array( 'label' => 'View all contacts', 'url' => array( 'index' ) ),
    array( 'label' => 'Add new contact', 'url' => array( 'create' ) ),
    array( 'label' => 'Update contact ', 'url' => array( 'update', 'id' => $model->id ) ),
    array(
        'label'       => 'Delete contact',
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array( 'delete', 'id' => $model->id ),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array( 'label' => 'Manage contacts', 'url' => array( 'admin' ) ),
);
?>

<h1>Information about <?php echo $model->name; ?></h1>


<?php
        $criteria = new CDbCriteria;
        $criteria->condition = "id = $model->category_id";
        $data = Category::model()->findAll( $criteria );
        $categoryType = CHtml::listData( $data, 'id', 'name' );

        foreach ( $categoryType as $key => $value ) {
            $category_name = $value;
        }


        $this->widget( 'bootstrap.widgets.TbDetailView', array(
            'data'       => $model,
            'type'       => 'hover',
            'attributes' => array(
                'name',
                'phone',
                'email',
                'address',
                //'field',
                //'created_by_user_id',

                array(
                    'name'  => 'Category',
                    'value' => $category_name,
                ),


            ),
        )
    );
?>
<table class="detail-view table" style="background-color: #fdfdfd ">

    <?php
    if ( $model->field != null ) {
        // data is save as JSON
        $old_data = $model->field;
        //encode the JSON data
        $new_data = json_decode( $old_data, true );
        //remove last element of an array, which is id of the user
        array_pop( $new_data );
    }
    $i = 0;
    ?>

    <tbody>
        <?php
        if ( $model->field != null ) {
            foreach ( $new_data as $key => $value ) {
                $class = ( $i++ % 2 == 0 ) ? 'even' : 'odd';
                echo "<tr " . ' class = ' . $class . ">";
                echo "<th>" . CHtml::encode( $key ) . "</th>";
                echo CHtml::tag( 'td', array(), $value );
                //echo CHtml::encode( $value ) . " \n";
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>



