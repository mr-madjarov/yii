<?php

class m140131_140705_initial extends CDbMigration
{
    public function up()
    {
        parent::up();
    }

    public function down()
    {
        parent::down();
    }


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        // =============================================================================================================
        // Create tables
        // =============================================================================================================

        $this->createTable( '{{auth_assignment}}', array(
                'itemname' => 'varchar(64) NOT NULL',
                'userid'   => 'int(10) unsigned NOT NULL',
                'bizrule'  => 'text',
                'data'     => 'text',
                'PRIMARY KEY (itemname, userid)',
                'KEY userid (userid)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createTable( '{{auth_item}}', array(
                'name'        => 'varchar(64) NOT NULL',
                'type'        => 'int(11) NOT NULL',
                'description' => 'text',
                'bizrule'     => 'text',
                'data'        => 'text',
                'PRIMARY KEY (name)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createTable( '{{auth_item_child}}', array(
                'parent' => 'varchar(64) NOT NULL',
                'child'  => 'varchar(64) NOT NULL',
                'PRIMARY KEY (parent, child)',
                'KEY child (child)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createTable( '{{user}}', array(
                'id'         => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'username'   => 'varchar(100) NOT NULL',
                'password'   => 'varchar(100) NOT NULL',
                'first_name' => 'varchar(100) DEFAULT NULL',
                'last_name'  => 'varchar(100) DEFAULT NULL',
                'active'     => 'tinyint(1) NOT NULL DEFAULT 1',
                'PRIMARY KEY (id)',
                'UNIQUE KEY username_UNIQUE (username)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        // =============================================================================================================
        // Add column constraints
        // =============================================================================================================

        // Table {{auth_assignment}}
        // -------------------------------------------------------------------------------------------------------------
        $this->addForeignKey( 'fk_auth_assignment_itemname_auth_item_name', '{{auth_assignment}}', 'itemname',
            '{{auth_item}}', 'name', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey( 'fk_auth_assignment_userid_user_id', '{{auth_assignment}}', 'userid', '{{user}}', 'id',
            'CASCADE', 'CASCADE'
        );

        // Table {{auth_item_child}}
        // -------------------------------------------------------------------------------------------------------------
        $this->addForeignKey( 'fk_auth_item_child_parent_auth_item_name', '{{auth_item_child}}', 'parent',
            '{{auth_item}}', 'name', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey( 'fk_auth_item_child_child_auth_item_name', '{{auth_item_child}}', 'child',
            '{{auth_item}}', 'name', 'CASCADE', 'CASCADE'
        );

        // =============================================================================================================
        // Initialize tables with data
        // =============================================================================================================

        // Table {{user}}
        // -------------------------------------------------------------------------------------------------------------
        $ph = new PasswordHash( Yii::app()->params[ 'phpass' ][ 'iteration_count_log2' ], Yii::app(
        )->params[ 'phpass' ][ 'portable_hashes' ] );
        $this->insert( '{{user}}', array(
                'username'   => 'admin',
                'password'   => $ph->HashPassword( 'admin' ),
                'first_name' => 'Administrator',
            )
        );
    }

    public function safeDown()
    {
        $this->dropTable( '{{auth_assignment}}' );
        $this->dropTable( '{{auth_item_child}}' );
        $this->dropTable( '{{auth_item}}' );
        $this->dropTable( '{{user}}' );
    }
}