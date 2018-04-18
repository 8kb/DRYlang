<?php
define('HOME', dirname(__FILE__));
// initialisation
ini_set('default_charset', 'UTF-8');
ini_set('auto_detect_line_endings',TRUE);
mb_internal_encoding("UTF-8");
// error
ini_set('error_reporting', E_ERROR | E_USER_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_RECOVERABLE_ERROR | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// autoload
spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    $filename = HOME.'/'.implode('/', $parts).'.php';
    if (file_exists($filename)) {
        require_once($filename);
    }
});