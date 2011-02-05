<?php

class m100916_194733_Nav extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{nav}}', array(
			'id' => 'pk',
			'root' => 'integer DEFAULT NULL',
			'lft' => 'integer NOT NULL',
			'rgt' => 'integer NOT NULL',
			'level' => 'integer NOT NULL',
			'type' => 'integer',
			'url' => 'string',
			'title' => 'string',
			'menu_title' => 'string',
			'text' => 'text',
		));
		$this->createIndex('root', '{{nav}}', 'root');
		$this->createIndex('lft', '{{nav}}', 'lft', true);
		$this->createIndex('rgt', '{{nav}}', 'rgt', true);
		$this->createIndex('level', '{{nav}}', 'level');
		$this->createIndex('url', '{{nav}}', 'url', true);
		$this->insert('{{nav}}', array(
			'lft' => 1,
			'rgt' => 2,
			'level' => 1,
			'url' => 'NULL',
		));
	}
	
	public function down()
	{
		$this->dropTable('{{nav}}');
	}
}
