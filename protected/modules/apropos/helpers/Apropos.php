<?php

class Apropos
{
	public static $excludeFolders = [
		'bdsm',
	];
	private static $_descriptors;
	private static $_synonyms;
	private static $_arousals;
	private static $_wearAndTears;
	private static $_srcPath;

	public static function descriptors($descriptorID = null, $randomValue = false, $includeSystem = true)
	{
		if (static::$_descriptors === null) {
			static::$_descriptors = [];
			$synonyms             = static::getSynonyms();
			$arousals             = static::getArousals();
			$wearAndTears         = static::getWearAndTears();
			$system               = [
				'{PRIMARY}' => ['Бестия'],
				'{ACTIVE}'  => ['Балгруф'],
				'{ACTIVE2}' => ['Ульфрик'],
			];
			// normalize arousals
			$_arousals = [];
			foreach ($arousals as $_descriptorID => $_descriptorValues) {
				$_arousals[$_descriptorID] = array_values(array_unique(call_user_func_array('array_merge', $_descriptorValues)));
			}
			// normalize wear and tear
			$_wearAndTears = [
				'{WTANAL}'    => [],
				'{WTORAL}'    => [],
				'{WTVAGINAL}' => [],
			];
			foreach (array_keys($_wearAndTears) as $_descriptorID) {
				foreach ($wearAndTears['descriptors'] as $_descriptorValues) {
					$_wearAndTears[$_descriptorID] = array_values(array_unique(array_merge($_wearAndTears[$_descriptorID], $_descriptorValues)));
				}
			}
			// normalize total list
			if ($includeSystem) {
				static::$_descriptors = array_merge(static::$_descriptors, $system);
			}
			static::$_descriptors = array_merge(static::$_descriptors, $_arousals);
			static::$_descriptors = array_merge(static::$_descriptors, $_wearAndTears);
			static::$_descriptors = array_merge(static::$_descriptors, $synonyms);
		}

		if ($descriptorID === null) {
			$_descriptors = static::$_descriptors;
			if ($randomValue) {
				foreach (static::$_descriptors as $_descriptorID => $_descriptorValue) {
					$_descriptors[$_descriptorID] = $_descriptorValue[rand(0, count($_descriptorValue)-1)];
				}
			} else {
				foreach ($_descriptors as $_descriptorID => &$_descriptorValue) {
					sort($_descriptorValue);
				}
			}
			return $_descriptors;
		}

		if (isset(static::$_descriptors[$descriptorID])) {
			if ($randomValue) {
				return static::$_descriptors[$descriptorID][rand(0, count(static::$_descriptors[$descriptorID])-1)];
			}
			return static::$_descriptors[$descriptorID];
		}

		throw new Exception(strtr('Invalid descriptor ID - `{descriptorID}`.', [
			'{descriptorID}' => $descriptorID,
		]));
	}

	public static function getSynonyms()
	{
		if (static::$_synonyms === null) {
			if((static::$_synonyms=json_decode(
				file_get_contents(
					static::getSrcPath() . '/Synonyms.txt'
				),
				true
			)) === null) {
				throw new Exception(strtr('Json of configs `{key}` is not valid.', [
					'{key}' => __METHOD__,
				]));
			}
		}
		return static::$_synonyms;
	}

	public static function getArousals()
	{
		if (static::$_arousals === null) {
			if((static::$_arousals=json_decode(
				file_get_contents(
					static::getSrcPath() . '/Arousal_Descriptors.txt'
				),
				true
			)) === null) {
				throw new Exception(strtr('Json of configs `{key}` is not valid.', [
					'{key}' => __METHOD__,
				]));
			}
		}
		return static::$_arousals;
	}

	public static function getWearAndTears()
	{
		if (static::$_wearAndTears === null) {
			if((static::$_wearAndTears=json_decode(
				file_get_contents(
					static::getSrcPath() . '/WearAndTear_Descriptors.txt'
				),
				true
			)) === null) {
				throw new Exception(strtr('Json of configs `{key}` is not valid.', [
					'{key}' => __METHOD__,
				]));
			}
		}
		return static::$_wearAndTears;
	}

	public static function setSrcPath($srcPath)
	{
		static::$_descriptors  = null;
		static::$_synonyms     = null;
		static::$_arousals     = null;
		static::$_wearAndTears = null;
		static::$_srcPath      = $srcPath;
	}

	public static function getSrcPath()
	{
		if (static::$_srcPath === null) {
			return static::getUtilsPath();
		}
		return static::$_srcPath;
	}

	public static function getUtilsPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/_db-utils';
	}
}
