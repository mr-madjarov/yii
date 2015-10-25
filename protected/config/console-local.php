<?php
return array(
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=phone_db;unix_socket=/tmp/mysql.sock',
            'emulatePrepare'   => true,
            'username'         => 'dev_02',
            'password'         => '123456',
            'charset'          => 'utf8',
            'tablePrefix'      => 'tbl_',
        ),
    ),
);
