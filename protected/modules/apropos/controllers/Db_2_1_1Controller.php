<?php
/**
 * Db_2_1_1Controller for [v2] only russian files
 * @docs http://amlgames.com/forums/topic/662-perevod-apropos-2
 */
class Db_2_1_1Controller extends DbJsonFixerController
{
	public $readmyFile = 'READMY-json-fixed.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-1-0/src';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-1-1';
	}
}
