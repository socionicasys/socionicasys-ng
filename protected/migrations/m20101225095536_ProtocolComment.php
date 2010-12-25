<?php

class m20101225095536_ProtocolComment extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{protocol}}', 'comment', 'string');
	}
	
	public function down()
	{
		$this->removeColumn('{{protocol}}', 'comment');
	}
}
