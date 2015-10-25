<?php

class m151018_114706_create_category extends CDbMigration
{



    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{category}}', array(
                'id'                 => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'name'               => 'varchar(64) NOT NULL',
                'parent_id'          => 'int(10) unsigned DEFAULT NULL',
                'created_by_user_id' => 'int(10) unsigned NOT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_category_parent_id_category_id',
            '{{category}}', 'parent_id',
            '{{category}}', 'id',
            'SET NULL', 'CASCADE'
        );
        $this->addForeignKey( 'fk_category_created_by_user_id_user_id',
            '{{category}}', 'created_by_user_id',
            '{{user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {

        $this->dropForeignKey( 'fk_category_created_by_user_id_user_id', '{{category}}' );
        $this->dropForeignKey( 'fk_category_parent_id_category_id', '{{category}}' );
        $this->dropTable( '{{category}}' );
    }

}