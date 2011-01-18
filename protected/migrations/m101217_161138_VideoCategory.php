<?php

class m101217_161138_VideoCategory extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{video}}', 'category', 'string');
		$this->addColumn('{{video}}', 'date', 'string');
	}

	public function down()
	{
		$this->removeColumn('{{video}}', 'category');
		$this->removeColumn('{{video}}', 'date');
	}
}
