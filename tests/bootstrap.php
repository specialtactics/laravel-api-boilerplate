<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
/** @var \Illuminate\Foundation\Console\Kernel $console */
$console = $app->make(Illuminate\Contracts\Console\Kernel::class);
$console->bootstrap();

// Migrate and seed test DB
$console->call('migrate:fresh', ['--seed' => true]);

// Clear all app cache
$app->cache->clear();
