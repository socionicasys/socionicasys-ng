<?php

class m110301_084730_ProtocolLegacyUrl extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{protocol}}', 'legacy_url', 'string');
	}

	public function down()
	{
		$this->dropColumn('{{protocol}}', 'legacy_url');
	}
}
