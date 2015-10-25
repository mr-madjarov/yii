<?php

class m151022_010831_alter_bookrecord_fk extends CDbMigration
{



	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addForeignKey( 'fk_book_record_category_id_category_id', '{{book_record}}', 'category_id',
            '{{category}}', 'id', 'CASCADE', 'CASCADE'
        );
	}

	public function safeDown()
	{

        $this->dropForeignKey( 'fk_book_record_category_id_category_id', '{{book_record}}' );
	}

}