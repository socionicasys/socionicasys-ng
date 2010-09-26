<?php

class m20100923114746_NavReindex extends CDbMigration
{
	public function up()
	{
		$this->removeIndex('{{nav}}', 'lft');
		$this->removeIndex('{{nav}}', 'rgt');
		$this->addIndex('{{nav}}', 'lft', array('lft'), false);
		$this->addIndex('{{nav}}', 'rgt', array('rgt'), false);
	}
	
	public function down()
	{
		$this->removeIndex('{{nav}}', 'lft');
		$this->removeIndex('{{nav}}', 'rgt');
		$this->addIndex('{{nav}}', 'lft', array('lft'), true);
		$this->addIndex('{{nav}}', 'rgt', array('rgt'), true);
	}
}
