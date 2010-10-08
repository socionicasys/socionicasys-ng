<?php

class m20101008002210_PageTypes extends CDbMigration
{
	public function up()
	{
		$this->execute('UPDATE {{nav}} SET type=1 WHERE type IS NULL and level<=2');
		$this->execute('UPDATE {{nav}} SET type=0 WHERE type IS NULL');
	}
	
	public function down()
	{
	}
}
