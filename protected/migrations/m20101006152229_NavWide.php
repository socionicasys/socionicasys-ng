<?php

class m20101006152229_NavWide extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{nav}}', 'wide_layout', 'boolean', 'DEFAULT FALSE');
	}
	
	public function down()
	{
		$this->removeColumn('{{nav}}', 'wide_layout');
	}
}
