<?php

class m100806_151304_News extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{news}}', array(
			'id' => 'pk',
			'title' => 'string NOT NULL',
			'text' => 'text NOT NULL',
			'post_time' => 'integer NOT NULL',
		));
	}

	public function down()
	{
		$this->dropTable('{{news}}');
	}
}
