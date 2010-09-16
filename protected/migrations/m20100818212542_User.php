<?php

class m20100818212542_User extends CDbMigration
{
	public function up()
	{
		$userTable = $this->newTable('{{user}}');
		$userTable->primary_key('id');
		$userTable->string('username', 128, 'NOT NULL');
		$userTable->string('password', 128);
		$userTable->string('salt', 128);
		$this->addTable($userTable);
	}

	public function down()
	{
		$this->removeTable('{{user}}');
	}
}
