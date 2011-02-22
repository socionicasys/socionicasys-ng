<?php

class m101106_121513_Quotes extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{quote}}', array(
			'id' => 'pk',
			'author' => 'string',
			'note' => 'string',
			'text' => 'text',
		));
	}
	
	public function down()
	{
		$this->dropTable('{{quote}}');
	}
}
