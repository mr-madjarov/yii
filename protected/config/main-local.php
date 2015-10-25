<?php
error_reporting( E_ALL | E_STRICT );
//define('DEFAULT_LANG_CATEGORY', 'bridge|');
return array(
    'timezone'   => 'Europe/Sofia',
    'modules'    => array(
        //*
        'gii' => array(
            'class'     => 'system.gii.GiiModule',
            'password'  => 'admin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array( '127.0.0.1', '::1', '*' ),
            'generatorPaths' => array(
                'bootstrap.gii'
             ),
        ), //*/
    ),
    'components' => array(
        /*'bootstrap' => array(
            'forceCopyAssets' => true,
        ),*/
        'db'           => array(
            'connectionString' => 'mysql:host=localhost;dbname=phone_db;unix_socket=/tmp/mysql.sock',
            'emulatePrepare'   => true,
            'username'         => 'dev_02',
            'password'         => '123456',
            'charset'          => 'utf8',
            'tablePrefix'      => 'tbl_',
        ),
        'assetManager' => array(
            'forceCopy' => true
        ),
    ),
);
