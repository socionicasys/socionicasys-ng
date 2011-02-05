<?php

class m100923_130025_NavRoot extends CDbMigration
{
	public function up()
	{
		// Заголовок для корня навигации
		$this->update('{{nav}}', array(
			'menu_title' => 'Сайт',
		), 'menu_title=NULL AND id=1');
	}
	
	public function down()
	{
		// Откат не реализован; не имеет смысла
	}
}
