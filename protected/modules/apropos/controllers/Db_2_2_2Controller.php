<?php
/**
 * Db_2_2_2Controller for [v2] only english files
 * @docs http://amlgames.com/forums/topic/662-perevod-apropos-2
 */
class Db_2_2_2Controller extends DbGrammarFixerController
{
	public $language   = 'en';
	public $readmyFile = 'READMY-punctuation-fixed.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-2-1/src';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-2-2';
	}
}
