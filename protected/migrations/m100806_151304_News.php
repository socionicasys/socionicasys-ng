<?php

class m100806_151304_News extends CDbMigration
{
	public function up()
	{
		$newsTable = $this->newTable('{{news}}');
		$newsTable->primary_key('id');
		$newsTable->string('title', 'NOT NULL');
		$newsTable->text('text', 'NOT NULL');
		$newsTable->integer('post_time', 'NOT NULL');
		$this->addTable($newsTable);
	}

	public function down()
	{
		$this->removeTable('{{news}}');
	}
}
