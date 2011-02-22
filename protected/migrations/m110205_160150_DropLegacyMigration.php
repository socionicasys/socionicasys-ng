<?php

class m110205_160150_DropLegacyMigration extends CDbMigration
{
	public function up()
	{
		$this->dropTable('schema_version');
	}

	public function down()
	{
	}
}
