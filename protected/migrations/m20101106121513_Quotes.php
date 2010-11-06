<?php

class m20101106121513_Quotes extends CDbMigration
{
	public function up()
	{
		$quoteTable = $this->newTable('{{quote}}');
		$quoteTable->primary_key('id');
		$quoteTable->string('author');
		$quoteTable->string('note');
		$quoteTable->text('text');
		$this->addTable($quoteTable);
	}
	
	public function down()
	{
		$this->removeTable('{{quote}}');
	}
}
