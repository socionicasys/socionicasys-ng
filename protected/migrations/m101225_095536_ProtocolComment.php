<?php

class m101225_095536_ProtocolComment extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{protocol}}', 'comment', 'string');
	}
	
	public function down()
	{
		$this->dropColumn('{{protocol}}', 'comment');
	}
}
