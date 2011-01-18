<?php

class m100907_154851_PhpbbUser extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{user}}', 'phpbb_id', 'integer');
		$this->addIndex('{{user}}', 'phpbb_id', array('phpbb_id'), true);
	}

	public function down()
	{
		$this->removeIndex('{{user}}', 'phpbb_id');
		$this->removeColumn('{{user}}', 'phpbb_id');
	}
}
