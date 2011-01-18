<?php

class m101103_212505_Metatags extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{nav}}', 'meta_description', 'string');
		$this->addColumn('{{nav}}', 'meta_keywords', 'string');
		$this->addColumn('{{library}}', 'meta_description', 'string');
		$this->addColumn('{{library}}', 'meta_keywords', 'string');
	}

	public function down()
	{
		$this->removeColumn('{{nav}}', 'meta_description');
		$this->removeColumn('{{nav}}', 'meta_keywords');
		$this->removeColumn('{{library}}', 'meta_description');
		$this->removeColumn('{{library}}', 'meta_keywords');
	}
}
