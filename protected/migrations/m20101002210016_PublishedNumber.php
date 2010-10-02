<?php

class m20101002210016_PublishedNumber extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{library}}', 'published_number', 'string');
	}
	
	public function down()
	{
		$this->removeColumn('{{library}}', 'published_number');
	}
}
