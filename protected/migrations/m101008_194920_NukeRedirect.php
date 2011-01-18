<?php

class m101008_194920_NukeRedirect extends CDbMigration
{
	public function up()
	{
		$redirectTable = $this->newTable('{{redirect}}');
		$redirectTable->primary_key('id');
		$redirectTable->string('group', 2);
		$redirectTable->string('page', 2);
		$redirectTable->string('model_class', 64);
		$redirectTable->integer('model_id');
		$redirectTable->unique('redirect.page', array('group', 'page'));
		$this->addTable($redirectTable);
	}
	
	public function down()
	{
		$this->removeTable('{{redirect}}');
	}
}
