<?php

class m150125_153828_create_user_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_news', array(
            'id' => 'pk',
            'email' => 'string NOT NULL',
            'content' => 'text',
        ));
	}

	public function down()
	{
		echo "m150125_153828_create_user_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}