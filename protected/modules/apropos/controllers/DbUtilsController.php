<?php
/**
 * DbUtilsController
 * 1. save all postfixes to descriptor-postfixes.json
 * 2. check all descriptors before replace by word
 * 3. On step of replace descriptors show all suffixes of each descriptor
 *    word case in all textes
 */
class DbUtilsController extends DbController
{
	public function actionUniqueSynonyms()
	{
		$path = $this->getPath();

		$synonyms = json_decode(file_get_contents($path . '/Synonyms.txt'), true);
		foreach ($synonyms as &$prefixes) {
			$prefixes = array_unique($prefixes);
			sort($prefixes);
		}
		file_put_contents($path . '/Synonyms.txt', json_encode($synonyms, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	}

	protected function getPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/_db-utils';
	}
}
