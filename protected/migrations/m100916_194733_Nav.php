<?php

class m100916_194733_Nav extends CDbMigration
{
	public function up()
	{
		$pageTable = $this->newTable('{{nav}}');
		$pageTable->primary_key('id');
		$pageTable->integer('root', 'DEFAULT NULL');
		$pageTable->integer('lft', 'NOT NULL');
		$pageTable->integer('rgt', 'NOT NULL');
		$pageTable->integer('level', 'NOT NULL');
		$pageTable->integer('type');
		$pageTable->string('url');
		$pageTable->string('title');
		$pageTable->string('menu_title');
		$pageTable->text('text');
		
		$pageTable->index('root', array('root'));
		$pageTable->unique('lft', array('lft'));
		$pageTable->unique('rgt', array('rgt'));
		$pageTable->index('level', array('level'));
		$pageTable->unique('url', array('url'));
		
		$this->addTable($pageTable);
		$this->execute('INSERT INTO {{nav}} (lft, rgt, level, url) VALUES (1, 2, 1, NULL)');
	}
	
	public function down()
	{
		$this->removeTable('{{nav}}');
	}
}
