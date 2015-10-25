<?php

class m151017_224851_create_book_record extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{book_record}}', array(
                'id'      => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'name'    => 'varchar(64) NOT NULL',
                'phone'   => 'integer NOT NULL',
                'email'   => 'varchar(64) DEFAULT NULL',
                'address' => 'varchar(100) DEFAULT NULL',
                'field'   => 'varchar(1024) DEFAULT NULL',
                'created_by_user_id'   => 'int(10) unsigned NOT NULL',
                'category_id'   => 'int(10) unsigned DEFAULT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_book_record_created_by_user_id_user_id',
            '{{book_record}}', 'created_by_user_id',
            '{{user}}', 'id',
            'CASCADE', 'CASCADE'
        );
     /*   $this->addForeignKey( 'fk_book_record_category_id_category_id',
            '{{book_record}}', 'category_id',
            '{{category}}', 'id',
            'CASCADE', 'CASCADE'
        );
     */
    }

    public function safeDown()
    {
        $this->dropForeignKey( 'fk_book_record_created_by_user_id_user_id', '{{book_record}}' );
        $this->dropForeignKey( 'fk_book_record_category_id_category_id', '{{book_record}}' );
        $this->dropTable( '{{book_record}}' );

    }

}