<?php
/**
 * 所有错误码都在此定义
 * @var integer
 */
$baseErrCode=1;
_define('SUCCESS',--$baseErrCode);
_define('METHOD_NOT_EXIST',--$baseErrCode);
_define('USER_NOT_LOGIN',--$baseErrCode);
_define('ACCESS_METHOD_DENIED',--$baseErrCode);

function _define($string,$val){
	define($string,$val);
	$GLOBALS['ERRCODE'][$val]=strtolower($string);
}