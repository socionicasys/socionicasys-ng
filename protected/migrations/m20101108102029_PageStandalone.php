<?php

class m20101108102029_PageStandalone extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{nav}}', 'standalone', 'boolean', 'DEFAULT 0');
	}
	
	public function down()
	{
		$this->removeColumn('{{nav}}', 'standalone');
	}
}
