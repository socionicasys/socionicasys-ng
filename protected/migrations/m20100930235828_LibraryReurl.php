<?php

class m20100930235828_LibraryReurl extends CDbMigration
{
	public function up()
	{
		$this->removeIndex('{{library}}', 'library.url');
		$this->addIndex('{{library}}', 'library.url', array('type', 'url'), true);
	}
	
	public function down()
	{
		$this->removeIndex('{{library}}', 'library.url');
		$this->addIndex('{{library}}', 'library.url', array('url'), true);
	}
}
