<?php

class m100930_235828_LibraryReurl extends CDbMigration
{
	public function up()
	{
		$this->dropIndex('library.url', '{{library}}');
		$this->createIndex('library.url', '{{library}}', 'type, url', true);
	}
	
	public function down()
	{
		$this->dropIndex('library.url', '{{library}}');
		$this->createIndex('library.url', '{{library}}', 'url', true);
	}
}
