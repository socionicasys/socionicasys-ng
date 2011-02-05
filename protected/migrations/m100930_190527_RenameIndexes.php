<?php

class m100930_190527_RenameIndexes extends CDbMigration
{
	public function up()
	{
		$this->dropIndex('root', '{{nav}}');
		$this->dropIndex('lft', '{{nav}}');
		$this->dropIndex('rgt', '{{nav}}');
		$this->dropIndex('level', '{{nav}}');
		$this->dropIndex('url', '{{nav}}');
		$this->createIndex('nav.root', '{{nav}}', 'root');
		$this->createIndex('nav.lft', '{{nav}}', 'lft');
		$this->createIndex('nav.rgt', '{{nav}}', 'rgt');
		$this->createIndex('nav.level', '{{nav}}', 'level');
		$this->createIndex('nav.url', '{{nav}}', 'url', true);
	}
	
	public function down()
	{
		$this->dropIndex('nav.root', '{{nav}}');
		$this->dropIndex('nav.lft', '{{nav}}');
		$this->dropIndex('nav.rgt', '{{nav}}');
		$this->dropIndex('nav.level', '{{nav}}');
		$this->dropIndex('nav.url', '{{nav}}');
		$this->createIndex('root', '{{nav}}', 'root');
		$this->createIndex('lft', '{{nav}}', 'lft');
		$this->createIndex('rgt', '{{nav}}', 'rgt');
		$this->createIndex('level', '{{nav}}', 'level');
		$this->createIndex('url', '{{nav}}', 'url', true);
	}
}
