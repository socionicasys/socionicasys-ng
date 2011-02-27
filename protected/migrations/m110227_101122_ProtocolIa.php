<?php

class m110227_101122_ProtocolIa extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{protocol}}', 'ia', 'boolean DEFAULT 1');
		$this->update('{{protocol}}', array(
			'ia' => 0,
		));
	}

	public function down()
	{
		$this->dropColumn('{{protocol}}', 'ia');
	}
}
