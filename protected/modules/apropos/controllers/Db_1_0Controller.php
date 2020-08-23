<?php
/**
 * Db_1_1_1Controller for [v1] original
 * @docs http://amlgames.com/mods-assemblies/author-assemblies/thorne-assemblies/seksrim-sse-60-leto-zimaosen-zima-bolshaya-sborka-obychnyh-i-seks-modov-r21
 */
class Db_1_0Controller extends DbSeparatorController
{
	public $version    = 1;
	public $readmyFile = 'READMY-removed-en-files.txt';

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-src/db-1-origin';
	}

	protected function getDstPathRu()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-1-1-0';
	}
}
