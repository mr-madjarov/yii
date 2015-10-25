<?php

class m151021_190900_alter_varchar extends CDbMigration
{


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
       // $this->dropColumn( '{{book_record}}', 'field' );

	}

	public function safeDown()
	{
       // $this->addColumn( '{{book_record}}', 'field', 'varchar(1024) DEFAULT NULL' );
	}

}