<?php

class m101224_124611_NavHidden extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{nav}}', 'hidden', 'boolean DEFAULT 0');
	}
	
	public function down()
	{
		$this->dropColumn('{{nav}}', 'hidden');
	}
}
