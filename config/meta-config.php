<?php

$applicationMode = isset($_SERVER['APPLICATION_MODE']) ?
        $_SERVER['APPLICATION_MODE'] : 'development';
if ($applicationMode == 'development') {
    ini_set('display_errors', '1');
    error_reporting('E_ALL');
    if (!function_exists('shutdown')) {
        function shutdown()
        {
            if (error_get_last()) {
                echo error_get_last() . "\n";
            }
        }
    }
    register_shutdown_function('shutdown');
} else {
    ini_set('display_errors', '0');
    error_reporting('E_NONE');
}

$proxiesFile = 'tmp/proxies';
