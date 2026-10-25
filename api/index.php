<?php

/**
 * Vercel Serverless Function Entry Point for Laravel
 */

// Siapkan folder sementara di /tmp karena storage lokal di Vercel sifatnya Read-Only
$tmpPaths = [
    '/tmp/views',
    '/tmp/cache',
    '/tmp/sessions',
    '/tmp/logs',
];

foreach ($tmpPaths as $path) {
    if (! is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

// Inisialisasi Database SQLite di /tmp jika menggunakan SQLite dan belum ada
$dbConnection = getenv('DB_CONNECTION') ?: 'sqlite';
if ($dbConnection === 'sqlite') {
    $targetDb = getenv('DB_DATABASE') ?: '/tmp/database.sqlite';
    $sourceDb = __DIR__.'/../database/database.sqlite';
    if (! file_exists($targetDb) && file_exists($sourceDb)) {
        @copy($sourceDb, $targetDb);
        @chmod($targetDb, 0666);
    }
}

// Teruskan seluruh request masuk ke public/index.php Laravel
require __DIR__.'/../public/index.php';
