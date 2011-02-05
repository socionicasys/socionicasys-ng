<?php

class m100907_154851_PhpbbUser extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{user}}', 'phpbb_id', 'integer');
		$this->createIndex('phpbb_id', '{{user}}', 'phpbb_id', true);
	}

	public function down()
	{
		$this->dropIndex('phpbb_id', '{{user}}');
		$this->dropColumn('{{user}}', 'phpbb_id');
	}
}
