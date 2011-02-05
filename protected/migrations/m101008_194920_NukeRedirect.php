<?php

class m101008_194920_NukeRedirect extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{redirect}}', array(
			'id' => 'pk',
			'group' => 'varchar(2)',
			'page' => 'varchar(2)',
			'model_class' => 'varchar(64)',
			'model_id' => 'integer',
		));
		$this->createIndex('redirect.page', '{{redirect}}', 'group, page', true);
	}
	
	public function down()
	{
		$this->dropTable('{{redirect}}');
	}
}
