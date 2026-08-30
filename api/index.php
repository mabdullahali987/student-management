<?php

// 1. Create required temporary directories for Vercel
$tmpDir = '/tmp/laravel';
$directories = [
    $tmpDir . '/storage/framework/views',
    $tmpDir . '/storage/framework/sessions',
    $tmpDir . '/storage/framework/cache',
    $tmpDir . '/storage/logs',
    $tmpDir . '/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Override Laravel's default paths to the writable /tmp directory
putenv('APP_CONFIG_CACHE=' . $tmpDir . '/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE=' . $tmpDir . '/bootstrap/cache/routes.php');
putenv('APP_EVENTS_CACHE=' . $tmpDir . '/bootstrap/cache/events.php');
putenv('APP_PACKAGES_CACHE=' . $tmpDir . '/bootstrap/cache/packages.php');
putenv('APP_SERVICES_CACHE=' . $tmpDir . '/bootstrap/cache/services.php');
putenv('VIEW_COMPILED_PATH=' . $tmpDir . '/storage/framework/views');

// 3. Prevent writing to files (use cookies for sessions and Vercel for logs)
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');

// 4. Boot the Laravel application
require __DIR__ . '/../public/index.php';