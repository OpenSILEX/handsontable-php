<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * config vendor path to use examples
 */

require_once __DIR__ . '/../../vendor/autoload.php';

//In native php
// if set load libraries from vendor if not load them from online server
use openSILEX\handsontablePHP\config\Config;
// change url vendor path
Config::setVendorPath("http://localhost/{app}/{vendor dir}/bower-asset");