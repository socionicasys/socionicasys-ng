<?php

class m20101114011126_RedirectUserimages extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{redirect}}', 'path', 'string');
		$this->addIndex('{{redirect}}', 'redirect.path', array('path'), true);
	}

	public function down()
	{
		$this->removeIndex('{{redirect}}', 'redirect.path');
		$this->removeColumn('{{redirect}}', 'path');
	}
}
