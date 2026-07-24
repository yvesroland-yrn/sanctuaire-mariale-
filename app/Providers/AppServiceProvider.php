<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole() && $this->isMigrationCommand()) {
            $this->createDatabaseIfMissing();
        }
    }

    protected function isMigrationCommand(): bool
    {
        $argv = $_SERVER['argv'] ?? [];
        $commandLine = implode(' ', $argv);

        return Str::contains($commandLine, 'migrate');
    }

    protected function createDatabaseIfMissing(): void
    {
        $connection = config('database.connections.mysql');
        $database = $connection['database'] ?? env('DB_DATABASE');

        if (empty($database) || strtolower($database) === 'forge') {
            return;
        }

        $host = $connection['host'] ?? env('DB_HOST', '127.0.0.1');
        $port = $connection['port'] ?? env('DB_PORT', '3306');
        $username = $connection['username'] ?? env('DB_USERNAME', 'root');
        $password = $connection['password'] ?? env('DB_PASSWORD', '');
        $charset = $connection['charset'] ?? 'utf8mb4';

        try {
            $dsn = "mysql:host={$host};port={$port};charset={$charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $pdo = new PDO($dsn, $username, $password, $options);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        } catch (\Throwable $exception) {
            Log::warning('Impossible de créer la base de données automatiquement : ' . $exception->getMessage());
        }
    }
}
