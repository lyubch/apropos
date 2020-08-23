<?php
/**
 * Db_2_3_1Controller for [v2] non-official extended update
 * @docs http://loverslab.com/files/file/10343-apropos2-text-db-update
 */
class Db_2_3_1Controller extends DbJsonFixerController
{
	public $language   = 'en';
	public $readmyFile = 'READMY-json-fixed.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-src/db-2-non-official';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-3-1';
	}
}
