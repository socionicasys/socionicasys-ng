<?php

class m101124_132350_Video extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{video}}', array(
			'id' => 'pk',
			'title' => 'string NOT NULL',
			'url' => 'string',
			'link' => 'string NOT NULL',
			'post_time' => 'integer',
			'comment' => 'text',
		));
		$this->createIndex('video.url', '{{video}}', 'url', true);
	}
	
	public function down()
	{
		$this->dropTable('{{video}}');
	}
}
