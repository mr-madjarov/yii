<?php

// Setup local configuration file
$localConfigFile = __DIR__ . DIRECTORY_SEPARATOR . 'console-local.php';
$localConfig = file_exists( $localConfigFile ) ? require( $localConfigFile ) : array();

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return CMap::mergeArray( array(
        'basePath'   => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
        'name'       => 'Billiard Manager',
        // preloading 'log' component
        'preload'    => array( 'log' ),
        // Auto-loading
        'import'     => array(
            'application.models.*',
            'application.vendor.phpass.PasswordHash',
            'application.components.*',
        ),
        // application components
        'components' => array(
            'authManager' => array(
                'class'           => 'VjDbAuthManager',
                'connectionID'    => 'db',
                'itemTable'       => '{{auth_item}}',
                'assignmentTable' => '{{auth_assignment}}',
                'itemChildTable'  => '{{auth_item_child}}',
                'defaultRoles'    => array( 'authenticated' ),
            ),
            'db'          => array(
                'connectionString' => 'mysql:host=localhost;dbname=phone_db;unix_socket=/tmp/mysql.sock',
                'emulatePrepare'   => true,
                'username'         => 'dev_02',
                'password'         => '123456',
                'charset'          => 'utf8',
                'tablePrefix'      => 'tbl_',
            ),
            'log'         => array(
                'class'  => 'CLogRouter',
                'routes' => array(
                    array(
                        'class'  => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                ),
            ),
        ),
    ), $localConfig
);