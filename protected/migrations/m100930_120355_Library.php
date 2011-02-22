<?php

class m100930_120355_Library extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{library}}', array(
			'id' => 'pk',
			'type' => 'string',
			'url' => 'string',
			'title' => 'string',
			'author' => 'string',
			'published' => 'string',
			'text' => 'text',
		));
		$this->createIndex('library.type', '{{library}}', 'type');
		$this->createIndex('library.url', '{{library}}', 'url', true);
	}
	
	public function down()
	{
		$this->dropTable('{{library}}');
	}
}
