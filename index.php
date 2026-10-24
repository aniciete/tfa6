<?php

/**
 * Laravel POS Foundations - Root Entry Point for Shared Hosting
 *
 * For shared hosting platforms like InfinityFree where document root
 * is fixed to /htdocs, this file ensures seamless bootstrapping.
 */

if (file_exists(__DIR__ . '/public/index.php')) {
    require_once __DIR__ . '/public/index.php';
} else {
    define('LARAVEL_START', microtime(true));

    if (file_exists($maintenance = __DIR__ . '/storage/framework/maintenance.php')) {
        require $maintenance;
    }

    require __DIR__ . '/vendor/autoload.php';

    /** @var \Illuminate\Foundation\Application $app */
    $app = require_once __DIR__ . '/bootstrap/app.php';

    $app->handleRequest(\Illuminate\Http\Request::capture());
}
