<?php
define('SEPARATOR', DIRECTORY_SEPARATOR);													#Define directory separator for create path.
define('WWWROOT', dirname(__FILE__).SEPARATOR.'..'.SEPARATOR.'app'.SEPARATOR.'www'); 		#Define access to the www folder path.
define('APPROOT', dirname(WWWROOT));  														#Define access to the app folder path.
define('ROOT', dirname(APPROOT));	  														#Define access to the main folder path.
define('CACHE', APPROOT.SEPARATOR.'cache');													#Define access to cache folder.
define('LIB', ROOT.SEPARATOR.'lib');														#Define access to lib folder.
define('CORE', LIB.SEPARATOR.'core');														#Define access to system core folder.
define('URL', 'http://localhost/Newsletter');

define('MODE', 'development');																#Define the project mode. (development or production)

if(file_exists(APPROOT.SEPARATOR.'config'.SEPARATOR.'configuration.php'))
	require APPROOT.SEPARATOR.'config'.SEPARATOR.'configuration.php';
require LIB.SEPARATOR.'functions.php';
require CORE.SEPARATOR.'http'.SEPARATOR.'Request.php';
require CORE.SEPARATOR.'http'.SEPARATOR.'Response.php';
require CORE.SEPARATOR.'http'.SEPARATOR.'Router.php';
require CORE.SEPARATOR.'Controller_SW.php';
require CORE.SEPARATOR.'Model_SW.php';
require CORE.SEPARATOR.'View_SW.php';
require CORE.SEPARATOR.'Plugin_SW.php';
require APPROOT.SEPARATOR.'core'.SEPARATOR.'AppController.php';
require APPROOT.SEPARATOR.'core'.SEPARATOR.'AppModel.php';
require APPROOT.SEPARATOR.'core'.SEPARATOR.'AppView.php';
require APPROOT.SEPARATOR.'core'.SEPARATOR.'AppPlugin.php';

require_once 'swiftmailer'.SEPARATOR.'lib'.SEPARATOR.'swift_required.php';

ob_start();
$startedAt = microtime(true);