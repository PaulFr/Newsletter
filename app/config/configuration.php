<?php

$config['development'] = array(
	'SITE_NAME'      => 'Site (PREPROD)',
	'DEFAULT_LAYOUT' => 'default',
	'DEBUG_MODE'     => 1,
    'PREFIX_PRIMARY_KEY' => false,
	'DATABASES'      => array(
		'default' => array(
			'host'          => 'localhost',
			'user'          => 'root',
			'password'      => 'root',
			'database' => 'newsletter',
			'prefix'        => '',
		),
	),
);
$config['production'] = array(
	'SITE_NAME'      => 'Site (PROD)',
	'DEFAULT_LAYOUT' => 'default',
	'DEBUG_MODE'     => 0,
    'PREFIX_PRIMARY_KEY' => false,
	'DATABASES'      => array(
		'default' => array(
			'host'          => 'localhost',
			'user'          => 'root',
			'password'      => 'root',
			'database' => 'newsletter',
			'prefix'        => '',
		),
	),
);

$config = isset($config[MODE]) ? $config[MODE] : $config['development'];

class Config{
	private static $config;

	public static function setConfig($conf){
		self::$config = $conf;
	}

	public static function get($key){
		return self::$config[$key];
	}
}

Config::setConfig($config);
unset($config);
?>
