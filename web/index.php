<?php
//定义全局常量
if( !defined('ROOT_PATH') ) define('ROOT_PATH', realpath('../').DIRECTORY_SEPARATOR);
if( !defined('BASE_PATH') ) define('BASE_PATH', realpath('../').DIRECTORY_SEPARATOR);
if( !defined('CONFIG_PATH') ) define('CONFIG_PATH', BASE_PATH.'data/config/');
if( !defined('ROOT_URL') ) define('ROOT_URL',  rtrim(dirname($_SERVER["SCRIPT_NAME"]), '\\/').'/');
if( !defined('PUBLIC_URL') ) define('PUBLIC_URL', ROOT_URL . 'public/');

require( $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/../framework/core.php' );
require_once ROOT_PATH.'/WebApp.php';
WebApp::run();