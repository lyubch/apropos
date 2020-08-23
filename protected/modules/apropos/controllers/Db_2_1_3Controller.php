<?php

/**
 * Db_2_1_3Controller for [v2] only russian files
 * @docs http://amlgames.com/forums/topic/662-perevod-apropos-2
 */
class Db_2_1_3Controller extends DbSpellingFixerController
{
	public $readmyFile			 = 'READMY-spelling-and-descriptors-fixed.txt';
	public $descriptorsParams	 = [
		'{ACTIVE}'		 => 'Маурус',
		'{ACTIVE2}'		 => 'Понтиак',
		'{PRIMARY}'		 => 'Бестия',
		'{FAROUSAL}'	 => 'нетерпелив',
		'{MAROUSAL}'	 => 'эрегированн',
		'{WTANAL}'		 => 'девственн',
		'{WTORAL}'		 => 'раскрыт',
		'{WTVAGINAL}'	 => 'изнасилованн',
		'{ACCEPTS}'		 => 'принимает',
		'{PUSS}'		 => 'пизд',
		'{RAPED}'		 => 'изнасилованы',
		'{RAPE}'		 => 'насилует',
		'{АСС}'			 => 'жоп',
		'{ACCEPT}'		 => 'взять',
		'{ASS}'			 => 'жоп',
		'{BEASTCOCK}'	 => 'фаллос',
		'{BEAST}'		 => 'здоровенн',
		'{BITCH}'		 => 'шлюх',
		'{BOOBS}'		 => 'сиськ',
		'{BUGCOCK}'		 => 'кол',
		'{COCK}'		 => 'член',
		'{CREAM}'		 => 'смазка',
		'{CUMMING}'		 => 'кончает',
		'{CUMMING1}'	 => 'кончая',
		'{CUMMING2}'	 => 'кончают',
		'{CUMS}'		 => 'кончил',
		'{CUM}'			 => 'сперм',
		'{DEAD}'		 => 'отвратительн',
		'{FEAR}'		 => 'ужас',
		'{FOREIGN}'		 => 'неизвестн',
		'{FUCKED}'		 => 'оттрахан',
		'{FUCKING}'		 => 'трах',
		'{FUCKS}'		 => 'трахает',
		'{FUCK}'		 => 'трахать',
		'{GENWT}'		 => 'изнасилованн',
		'{HEAVING}'		 => 'сексуальн',
		'{HOLES}'		 => 'дырки',
		'{HORNY}'		 => 'возбужденн',
		'{HUGELOAD}'	 => 'массивн',
		'{HUGE}'		 => 'волосат',
		'{INSERT}'		 => 'вставлять',
		'{INSERTS}'		 => 'вставляет',
		'{JUICY}'		 => 'мокр',
		'{LARGELOAD}'	 => 'здоровенн',
		'{LOUDLY}'		 => 'бессовестно',
		'{MACHINESLIME}' => 'масло',
		'{MACHINESLIMY}' => 'вязк',
		'{MACHINE}'		 => 'робот',
		'{METAL}'		 => 'холодн',
		'{MOANING}'		 => 'стоная',
		'{MOANS}'		 => 'стонет',
		'{MOAN}'		 => 'стонать',
		'{MOUTH}'		 => 'рот',
		'{OPENING}'		 => 'щелк',
		'{PENIS}'		 => 'пенис',
		'{PROBE}'		 => 'зонд',
		'{PUSSY}'		 => 'пизд',
		'{QUIVERING}'	 => 'дрожащ',
		'{SALTY}'		 => 'вонючий',
		'{SCREAMS}'		 => 'визжит',
		'{SLIME}'		 => 'склизск',
		'{SLIMY}'		 => 'мерзкий',
		'{SLOPPY}'		 => 'влажн',
		'{SLUTTY}'		 => 'нагл',
		'{SODOMIZED}'	 => 'содомирована',
		'{SODOMIZES}'	 => 'содомирует',
		'{SODOMIZE}'	 => 'содомировать',
		'{SODOMIZING}'	 => 'содомирующий',
		'{SOLID}'		 => 'гигантский',
		'{STRAPON}'		 => 'страпон',
		'{SWEARING}'	 => 'Блядь!',
		'{TASTY}'		 => 'солен',
		'{THICK}'		 => 'тепл',
		'{UNTHINKING}'	 => 'безразличн',
		'{VILE}'		 => 'противн',
		'{WHORE}'		 => 'давалк',
	];
	public $excludeError		 = [
		'закачивает',
		'приближаю',
	];
	public $replaceError		 = [
		'пизди' => 'пизды',
	];
	public $replaceBefore        = [
		'¤'        => 'я',
		'∆ивот'    => 'Живот',
		'Ѕоги'     => 'Боги',
		'Ќгромный' => 'Огромный',
		'Ћои'      => 'Мои',
		'≈е'       => 'Её',
	];
	public $replaceAfter		 = [
		
	];

	protected function getSrcPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-1-2/src';
	}

	protected function getDstPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/db-2-1-3';
	}
}
