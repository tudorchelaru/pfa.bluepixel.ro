<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$host = strtolower(explode(':', $_SERVER['HTTP_HOST'] ?? '')[0]);

if (in_array($host, ['pfa.bluepixel.ro', 'www.pfa.bluepixel.ro'], true)) {
    $targetUrl = 'https://nuva.ro';

    header('Content-Type: text/html; charset=UTF-8');
    echo <<<HTML
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redirecting...</title>
    <meta http-equiv="refresh" content="4;url={$targetUrl}">
    <style>
        :root { color-scheme: light; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top, #ffffff, #eef3f8);
            color: #111827;
        }
        .wrapper {
            text-align: center;
            padding: 24px;
        }
        .spinner {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 10px solid #d1d5db;
            border-top-color: #111827;
            margin: 0 auto 24px;
            animation: spin 1s linear infinite;
        }
        .message {
            font-size: clamp(24px, 2.7vw, 36px);
            font-weight: 700;
            line-height: 1.25;
            margin: 0 0 10px;
        }
        .hint {
            font-size: 16px;
            margin: 0;
            color: #4b5563;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
    <script>
        setTimeout(function () {
            window.location.replace('{$targetUrl}');
        }, 3800);
    </script>
</head>
<body>
    <main class="wrapper">
        <div class="spinner" aria-hidden="true"></div>
        <p class="message">Va invitam pe noul site nuva.ro</p>
        <p class="hint">Veti fi redirectionat imediat...</p>
    </main>
</body>
</html>
HTML;
    exit;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
