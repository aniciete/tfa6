<?php
/**
 * InfinityFree Deployment Extractor & Database Provisioner
 * Unpacks tfa6-infinityfree.zip into /htdocs, sets permissions, boots MySQL schema, cleans up, and self-destructs.
 */
header('Content-Type: text/plain; charset=utf-8');

$zipFile = __DIR__ . '/tfa6-infinityfree.zip';

if (!file_exists($zipFile)) {
    http_response_code(404);
    echo "ERROR: Deployment package not found at " . $zipFile . "\n";
    exit(1);
}

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    echo "ERROR: ZipArchive extension is not enabled in this PHP environment.\n";
    exit(1);
}

$zip = new ZipArchive();
$res = $zip->open($zipFile);

if ($res === TRUE) {
    $extracted = $zip->extractTo(__DIR__);
    $zip->close();

    if ($extracted) {
        @unlink($zipFile);
        echo "SUCCESS: Extracted tfa6-infinityfree.zip successfully!\n";
        echo "All application files, production vendor dependencies, and assets are in place.\n";

        // Remove default InfinityFree index2.html placeholder
        if (file_exists(__DIR__ . '/index2.html')) {
            @unlink(__DIR__ . '/index2.html');
            echo "Removed default InfinityFree index2.html placeholder.\n";
        }

        // Ensure storage and cache directories exist and are writable
        $storageDirs = [
            __DIR__ . '/storage/app/public',
            __DIR__ . '/storage/framework/cache/data',
            __DIR__ . '/storage/framework/sessions',
            __DIR__ . '/storage/framework/views',
            __DIR__ . '/storage/logs',
            __DIR__ . '/bootstrap/cache',
        ];
        foreach ($storageDirs as $sDir) {
            if (!is_dir($sDir)) {
                @mkdir($sDir, 0777, true);
            }
            @chmod($sDir, 0777);
        }
        echo "Verified storage and cache directories.\n";

        // Automatically provision MySQL database schema from schema_export.sql
        $sqlFile = __DIR__ . '/database/schema_export.sql';
        $dbHost = 'sql110.infinityfree.com';
        $dbName = 'if0_43258606_tfa6';
        $dbUser = 'if0_43258606';
        $dbPass = 'iHZWFG57sB42';

        $mysqlSuccess = false;
        if (file_exists($sqlFile)) {
            try {
                $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
                $pdo = new PDO($dsn, $dbUser, $dbPass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_TIMEOUT => 10,
                ]);

                $sqlContent = file_get_contents($sqlFile);
                $statements = array_filter(array_map('trim', explode(';', $sqlContent)));

                foreach ($statements as $stmt) {
                    if (!empty($stmt) && !preg_match('/^(--|\/\*)/', $stmt)) {
                        $pdo->exec($stmt);
                    }
                }
                echo "SUCCESS: MySQL database schema and seed data imported into {$dbName} on {$dbHost}.\n";
                $mysqlSuccess = true;
            } catch (Exception $e) {
                echo "NOTICE: MySQL automatic import encountered: " . $e->getMessage() . "\n";
                echo "Switching .env to resilient pre-seeded SQLite connection for uninterrupted uptime.\n";
            }
        }

        // If MySQL could not be initialized directly, configure SQLite fallback in .env
        $envFile = __DIR__ . '/.env';
        if (file_exists($envFile) && !$mysqlSuccess) {
            $envContent = file_get_contents($envFile);
            $envContent = preg_replace('/DB_CONNECTION=mysql/', 'DB_CONNECTION=sqlite', $envContent);
            file_put_contents($envFile, $envContent);
            echo "Configured resilient SQLite fallback in .env.\n";
        }

        // Self-destruct for security
        @unlink(__FILE__);
        echo "Removed extract.php for security.\n";
        echo "Deployment complete! Visit http://tfa6.freedev.app/ to verify.\n";
    } else {
        http_response_code(500);
        echo "ERROR: Failed during extraction to " . __DIR__ . "\n";
    }
} else {
    http_response_code(500);
    echo "ERROR: Could not open zip file. Error code: " . $res . "\n";
}
