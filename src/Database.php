<?php

namespace FluxPHP\Source;

class Database
{
    public static \PDO $pdo;

    public static function connect()
    {
        self::$pdo = new \PDO("mysql:host=" . Flux::getEnv("DB_HOSTNAME") . ";port=" . Flux::getEnv("DB_PORT", 3306) . ";dbname=" . Flux::getEnv("DB_DATABASE"), Flux::getEnv("DB_NAME"), Flux::getEnv("DB_PASSWORD"));
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return self::$pdo;
    }
}
