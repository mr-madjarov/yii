<?php
/*
 *
 * */
?>
<div class="view">

<!--    <b><?php /*echo CHtml::encode( $data->getAttributeLabel( 'id' ) ); */?>:</b>
    <?php /*echo CHtml::link( CHtml::encode( $data->id ), array( 'view', 'id' => $data->id ) ); */?>
    <br/>-->

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'name' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->name ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'phone' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->phone ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'email' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->email ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'address' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->address ); ?>
    <br/>

    <?php
    if ( $data->field != null) {
        // data is save as JSON
        $old_data = $data->field;
        //encode the JSON data
        $new_data = json_decode( $old_data, true );
        //remove last element of an array, which is id of the user
        array_pop( $new_data );

        $new_data != null;
        foreach ( $new_data as $key => $value ) {
            echo "<b>" . CHtml::encode( $key ) . ":</b>" . "\n";
            echo CHtml::encode( $value ) . "\n";
            echo "<br>";
        }
    }

    ?>
<!--    <b><?php /*echo CHtml::encode( $data->getAttributeLabel( 'created_by_user_id' ) ); */?>:</b>
    <?php /*echo CHtml::encode( $data->created_by_user_id ); */?>
    <br/>-->

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'category_id' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->category_id ); ?>
    <br/>


</div>