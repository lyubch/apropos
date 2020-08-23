<?php
/**
 * Db_2_2_1Controller for [v2] only english files
 * @docs http://amlgames.com/forums/topic/662-perevod-apropos-2
 */
class Db_2_2_1Controller extends DbJsonFixerController
{
	public $language   = 'en';
	public $readmyFile = 'READMY-json-fixed.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-2-0/src';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-2-1';
	}
}
