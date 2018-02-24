<?php

$applicationMode = isset($_SERVER['applicationMode']) ? $_SERVER['applicationMode'] : 'development';
if ($applicationMode == 'development') {
    ini_set('display_errors', '1');
    error_reporting('E_ALL');
    if (!function_exists('shutdown')) {
        function shutdown()
        {
            var_dump(error_get_last());
        }
    }
    register_shutdown_function('shutdown');
} else {
    ini_set('display_errors', '0');
    error_reporting('E_NONE');
}