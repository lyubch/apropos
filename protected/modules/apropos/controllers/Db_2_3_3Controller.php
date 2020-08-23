<?php
/**
 * Db_2_3_3Controller for [v2] non-official extended update
 * @docs http://loverslab.com/files/file/10343-apropos2-text-db-update
 */
class Db_2_3_3Controller extends DbTranslatorController
{
	public $language   = 'en';
	public $readmyFile = 'READMY-ru-translate.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-3-2/src';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-3-3';
	}
}
