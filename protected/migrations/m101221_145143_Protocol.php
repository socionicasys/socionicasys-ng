<?php

class m101221_145143_Protocol extends CDbMigration
{
	public function up()
	{
		$protocolTable = $this->newTable('{{protocol}}');
		$protocolTable->primary_key('id');
		$protocolTable->string('name', 'NOT NULL');
		$protocolTable->string('tim');
		$protocolTable->string('date');
		$protocolTable->string('url');
		$protocolTable->unique('protocol.name', array('name'));
		$protocolTable->index('protocol.tim', array('tim'));
		$protocolTable->index('protocol.date', array('date'));
		$this->addTable($protocolTable);
	}

	public function down()
	{
		$this->removeTable('{{protocol}}');
	}
}
