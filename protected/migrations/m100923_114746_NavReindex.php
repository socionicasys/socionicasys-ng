<?php

class m100923_114746_NavReindex extends CDbMigration
{
	public function up()
	{
		$this->dropIndex('lft', '{{nav}}');
		$this->dropIndex('rgt', '{{nav}}');
		$this->createIndex('lft', '{{nav}}', 'lft');
		$this->createIndex('rgt', '{{nav}}', 'rgt');
	}
	
	public function down()
	{
		$this->dropIndex('lft', '{{nav}}');
		$this->dropIndex('rgt', '{{nav}}');
		$this->createIndex('lft', '{{nav}}', 'lft', true);
		$this->createIndex('rgt', '{{nav}}', 'rgt', true);
	}
}
