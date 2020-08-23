<?php
//*********************//
//*** Debug Helpers ***//
//*********************//
const DH   = '__dump_highlight';
const DD1  = '__dump_depth_1';
const DD2  = '__dump_depth_2';
const DD3  = '__dump_depth_3';
const DD4  = '__dump_depth_4';
const DD5  = '__dump_depth_5';
const DD10 = '__dump_depth_10';
const DD20 = '__dump_depth_20';

function dump()
{
    call_user_func_array('dumpp', func_get_args()) && exit;
}

function dumpp()
{
    $params = array(func_get_args());
	// default depth
    $params[1] = 4;
	// default highlight
    $params[2] = true;

	foreach ($params[0] as $key => $value) {
		// default depth if object exists
		if (is_object($value)) {
			$params[1] = 2;
		}
	}

	foreach ($params[0] as $key => $value) {
		if ($value === DD1) {
			$params[1] = 2;
			unset($params[0][$key]);
		} elseif ($value === DD2) {
			$params[1] = 3;
			unset($params[0][$key]);
		} elseif ($value === DD3) {
			$params[1] = 4;
			unset($params[0][$key]);
		} elseif ($value === DD4) {
			$params[1] = 5;
			unset($params[0][$key]);
		} elseif ($value === DD5) {
			$params[1] = 6;
			unset($params[0][$key]);
		} elseif ($value === DD10) {
			$params[1] = 11;
			unset($params[0][$key]);
		} elseif ($value === DD20) {
			$params[1] = 21;
			unset($params[0][$key]);
		} elseif ($value === DH) {
			$params[2] = true;
			unset($params[0][$key]);
		}
	}
	$params[0] = array_values($params[0]);

    call_user_func_array(
        'CVarDumper::dump',
        $params
    );

    return true;
}
//*********************//
