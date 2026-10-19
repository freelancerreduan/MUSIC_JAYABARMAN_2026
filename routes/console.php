<?php

use Illuminate\Support\Facades\Artisan;

/*
 * php artisan site:setup
 * Creates the MySQL database when it is missing, runs new migrations and fills in
 * missing content. Safe to run every time: nothing changed in the admin panel is overwritten.
 */
Artisan::command('site:setup', function () {
    $db = config('database.connections.mysql');

    try {
        $pdo = new PDO("mysql:host={$db['host']};port={$db['port']}", $db['username'], $db['password']);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$db['database']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    } catch (PDOException $e) {
        $this->error("MySQL is not reachable on {$db['host']}:{$db['port']}. Start Laragon (or MySQL) and try again.");
        $this->line($e->getMessage());

        return 1;
    }
    $this->info("Database `{$db['database']}` is ready.");

    $this->call('migrate', ['--force' => true]);
    $this->call('db:seed', ['--force' => true]);

    if (! is_dir(public_path('uploads'))) {
        mkdir(public_path('uploads'), 0755, true);
    }

    $this->info('Setup finished.');

    return 0;
})->purpose('Create the database, migrate and seed (safe to run again)');
