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
    if (!is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

// Teruskan seluruh request masuk ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
