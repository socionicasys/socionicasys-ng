<?php

class m20101124132350_Video extends CDbMigration
{
	public function up()
	{
		$videoTable = $this->newTable('{{video}}');
		$videoTable->primary_key('id');
		$videoTable->string('title', 'NOT NULL');
		$videoTable->string('url');
		$videoTable->string('link', 'NOT NULL');
		$videoTable->integer('post_time');
		$videoTable->text('comment');
		$videoTable->unique('video.url', array('url'));
		$this->addTable($videoTable);
	}
	
	public function down()
	{
		$this->removeTable('{{video}}');
	}
}
