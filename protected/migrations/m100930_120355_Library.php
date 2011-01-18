<?php

class m100930_120355_Library extends CDbMigration
{
	public function up()
	{
		$libraryTable = $this->newTable('{{library}}');
		$libraryTable->primary_key('id');
		$libraryTable->string('type');
		$libraryTable->string('url');
		$libraryTable->string('title');
		$libraryTable->string('author');
		$libraryTable->string('published');
		$libraryTable->text('text');
		
		$libraryTable->index('library.type', array('type'));
		$libraryTable->unique('library.url', array('url'));
		
		$this->addTable($libraryTable);
	}
	
	public function down()
	{
		$this->removeTable('{{library}}');
	}
}
