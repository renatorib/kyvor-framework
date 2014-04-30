<?php

/*
 * DIRECTORY SEPARATOR
 */
define('DS', DIRECTORY_SEPARATOR);

/*
 * VIEW DIRECTORY
 */
define('PAGES', 'view');

/*
 * VIEW DIRECTORY
 */
define('LIB', 'lib');

/*
 * CONFIGs
 */

require 'config.php';

/*
 * UTILS
 */
require 'utils.php';

/*
 * APP
 */
require 'app.php';

/*
 * GLOBAL CONTROLLER
 */
require 'controller.php';

/*
 * DISPATCH
 */
$app = new app();

if($app->layout){
	if($app->layout === true) {
		require 'view/layouts/default.php';
	} else {
		if(file_exists('view/layouts/' . $app->layout . '.php')){
			require 'view/layouts/' . $app->layout . '.php';
		}
	}
}