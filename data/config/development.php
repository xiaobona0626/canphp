<?php 
return array (
	'DEBUG' => true,
	
	//route config
	'REWRITE_ON' => 'false', 		
	'REWRITE_RULE' =>array(
		//'<app>/<c>/<a>'=>'<app>/<c>/<a>',
	),
	
	//db config
	'DB'=>array(
		'default' => 
			array (
				'DB_TYPE' => 'mysqlpdo',
				'DB_HOST' => '192.168.101.94',
				'DB_USER' => 'root',
				'DB_PWD' => 'edaili123.',
				'DB_PORT' => '3306',
				'DB_NAME' => 'edaili',
				'DB_CHARSET' => 'utf8',
				'DB_PREFIX' => '',
			),
		'db2' =>
			array(
				'DB_TYPE' => 'mysqlpdo',
				'DB_HOST' => '192.168.101.94',
				'DB_USER' => 'root',
				'DB_PWD' => 'edaili123.',
				'DB_PORT' => '3306',
				'DB_NAME' => 'test2',
				'DB_CHARSET' => 'utf8',
				'DB_PREFIX' => '',
			)
	),
);