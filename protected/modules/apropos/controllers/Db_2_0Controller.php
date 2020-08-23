<?php
/**
 * Db_2_0Controller for separate v2 on ru and en files
 * @docs http://amlgames.com/forums/topic/662-perevod-apropos-2
 */
class Db_2_0Controller extends DbSeparatorController
{
	public $readmyFile = 'READMY-removed-en-files.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-src/db-2-myname';
	}

	protected function getDstPathRu()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-1-0';
	}

	protected function getDstPathEn()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-2-0';
	}
}
