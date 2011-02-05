<?php

class m101006_152229_NavWide extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{nav}}', 'wide_layout', 'boolean DEFAULT 0');
	}
	
	public function down()
	{
		$this->dropColumn('{{nav}}', 'wide_layout');
	}
}
