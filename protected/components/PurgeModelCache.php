<?php

class PurgeModelCache extends CActiveRecordBehavior
{
	public function afterSave($event)
	{
		$this->purgeCache();
	}

	public function afterDelete($event)
	{
		$this->purgeCache();
	}

	protected function purgeCache()
	{
		Yii::app()->getCache()->flush();
	}
}
