<?php

class m20100930190527_RenameIndexes extends CDbMigration
{
	public function up()
	{
		$this->removeIndex('{{nav}}', 'root');
		$this->removeIndex('{{nav}}', 'lft');
		$this->removeIndex('{{nav}}', 'rgt');
		$this->removeIndex('{{nav}}', 'level');
		$this->removeIndex('{{nav}}', 'url');
		$this->addIndex('{{nav}}', 'nav.root', array('root'), false);
		$this->addIndex('{{nav}}', 'nav.lft', array('lft'), false);
		$this->addIndex('{{nav}}', 'nav.rgt', array('rgt'), false);
		$this->addIndex('{{nav}}', 'nav.level', array('level'), false);
		$this->addIndex('{{nav}}', 'nav.url', array('url'), true);
	}
	
	public function down()
	{
		$this->removeIndex('{{nav}}', 'nav.root');
		$this->removeIndex('{{nav}}', 'nav.lft');
		$this->removeIndex('{{nav}}', 'nav.rgt');
		$this->removeIndex('{{nav}}', 'nav.level');
		$this->removeIndex('{{nav}}', 'nav.url');
		$this->addIndex('{{nav}}', 'root', array('root'), false);
		$this->addIndex('{{nav}}', 'lft', array('lft'), false);
		$this->addIndex('{{nav}}', 'rgt', array('rgt'), false);
		$this->addIndex('{{nav}}', 'level', array('level'), false);
		$this->addIndex('{{nav}}', 'url', array('url'), true);
	}
}
