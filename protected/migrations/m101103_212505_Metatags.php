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
		$this->dropColumn('{{nav}}', 'meta_description');
		$this->dropColumn('{{nav}}', 'meta_keywords');
		$this->dropColumn('{{library}}', 'meta_description');
		$this->dropColumn('{{library}}', 'meta_keywords');
	}
}
