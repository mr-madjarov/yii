<?php
/**
 * Created by PhpStorm.
 * User: mrmadjarov
 * Date: 17.10.2015 г.
 * Time: 23:10
 *
/* @var $this AdminPanelController */



?>
<div class="well my-well">
    <div class="inner-head">
        <h2> <?php echo t( 'Admin Panel' ) ?></h2>
    </div>

    <div class="inner-content">
        <?php
        echo CHtml::button( 'Users', array( 'submit' => array( '/user/index' ) ) );
        echo CHtml::button( 'Create user', array( 'submit' => array( '/user/create' ) ) );
        echo CHtml::button( 'Manage users', array( 'submit' => array( '/user/admin' ) ) );

        ?>
    </div>
</div>

