<?php

class m101008_002210_PageTypes extends CDbMigration
{
	public function up()
	{
		$this->update('{{nav}}', array(
			'type' => 1,
		), 'type IS NULL AND level<=2');
		$this->update('{{nav}}', array(
			'type' => 0,
		), 'type IS NULL');
	}
	
	public function down()
	{
	}
}
