<?php
/**
 * Db_1_1_2Controller for [v1] original
 * @docs http://amlgames.com/mods-assemblies/author-assemblies/thorne-assemblies/seksrim-sse-60-leto-zimaosen-zima-bolshaya-sborka-obychnyh-i-seks-modov-r21
 */
class Db_1_1_2Controller extends DbGrammarFixerController
{
	public $version    = 1;
	public $readmyFile = 'READMY-punctuation-fixed.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-1-1-1/src';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-1-1-2';
	}
}
