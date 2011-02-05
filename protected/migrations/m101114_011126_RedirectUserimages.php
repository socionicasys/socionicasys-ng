<?php

class m101114_011126_RedirectUserimages extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{redirect}}', 'path', 'string');
		$this->createIndex('redirect.path', '{{redirect}}', 'path', true);
	}

	public function down()
	{
		$this->dropIndex('redirect.path', '{{redirect}}');
		$this->dropColumn('{{redirect}}', 'path');
	}
}
