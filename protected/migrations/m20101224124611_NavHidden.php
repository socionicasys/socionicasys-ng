<?php

class m20101224124611_NavHidden extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{nav}}', 'hidden', 'boolean', 'DEFAULT 0');
	}
	
	public function down()
	{
		$this->removeColumn('{{nav}}', 'hidden');
	}
}
