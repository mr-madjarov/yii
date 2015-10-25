<?php
/**
 * Created by PhpStorm.
 * User: mrmadjarov
 * Date: 17.10.2015 г.
 * Time: 23:10
 *
/* @var $this AdminPanelController */

function createButton( $linkText, $spanClass, $action, $spanText = "Edit" )
{
    return CHtml::link( CHtml::tag( 'span', array( 'class' => 'large-btn-txt' ), t( $linkText ) ) . CHtml::tag( 'span',
            array( 'class' => 'large-btn-pop' ), t( $spanText )
        ), $action, array( 'class' => 'large-btn ' . $spanClass )
    );
}

?>
<div class="well my-well">
    <div class="inner-head">
        <h2> <?php echo t( 'Admin Panel' ) ?></h2>
    </div>

    <div class="inner-content">
        <?php
        echo createButton( 'Users', 'btn-user-c', array( "user/index" ), 'Review' );
        echo createButton( 'Documents', 'btn-register', array( "document/admin" ) );
        echo createButton( 'Category', 'btn-info-2', array( "category/admin" ) );
        //        echo createButton( 'Excel reports', 'btn-excel', "index", 'Review' );
        //        echo createButton( 'Stop system', 'btn-lock', "index", "Stop" );
        //
        //        echo createButton( 'Email', 'btn-mail', array( "config/email" ) );
        //        echo createButton( 'Price list', 'btn-money', array( "priceList/index" ), 'Review' );
        echo createButton( 'Register', 'btn-paketi', array( "register/index", 'Review' ) );
        //        echo createButton( 'Coordinates', 'btn-coordinates', array( 'coordinateConfig/update' ) );
        ?>
    </div>
</div>

