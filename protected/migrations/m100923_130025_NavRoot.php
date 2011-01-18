<?php

class m100923_130025_NavRoot extends CDbMigration
{
	public function up()
	{
		// Заголовок для корня навигации
		$this->execute('UPDATE {{nav}} SET menu_title=:title WHERE menu_title=NULL AND id=1', array(
			'title' => 'Сайт',
		));
	}
	
	public function down()
	{
		// Откат не реализован; не имеет смысла
	}
}
