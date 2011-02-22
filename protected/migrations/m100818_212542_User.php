<?php

class m100818_212542_User extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{user}}', array(
			'id' => 'pk',
			'username' => 'string NOT NULL',
			'password' => 'string NOT NULL',
			'salt' => 'string NOT NULL',
		));
	}

	public function down()
	{
		$this->dropTable('{{user}}');
	}
}
