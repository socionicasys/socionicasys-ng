<?php

class m101221_145143_Protocol extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{protocol}}', array(
			'id' => 'pk',
			'name' => 'string NOT NULL',
			'tim' => 'string',
			'date' => 'string',
			'url' => 'string',
		));
		$this->createIndex('protocol.name', '{{protocol}}', 'name', true);
		$this->createIndex('protocol.tim', '{{protocol}}', 'tim');
		$this->createIndex('protocol.date', '{{protocol}}', 'date');
	}

	public function down()
	{
		$this->dropTable('{{protocol}}');
	}
}
