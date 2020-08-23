<?php

Yii::setPathOfAlias('vendor', dirname(__FILE__) . '/../../vendor');

// This is the main Web application configuration.
$main = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'modules' => array(
		'apropos',
    ),
    'components' => array(
        'urlManager'   => array(
            'showScriptName' => false,
            'urlFormat'      => 'path',
            'rules'          => array(
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
    ),
);

if (YII_DEBUG) {
	// DISPLAY ERRORS
	ini_set('display_errors', 1);
	error_reporting(-1);
	// DEBUG
	require_once(__DIR__ . '/debug.php');
}

return $main;
