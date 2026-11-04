<?php
class Database
{
    private function __construct() {}
    private function __clone() {}

    private const DB_HOST = "localhost";
    private const DB_USER = "dylan";
    private const DB_PASSWORD = "root";
    private const DB_NAME = "kerdrink";

    private static PDO | null $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            try {
                $dsn = "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"] . ";charset=utf8";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$instance = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASSWORD"], $options);
            } catch (PDOException $e) {
                error_log($e);
                die("Erreur lors de l'instanciation de la base de données.");
            }
        }

        return self::$instance;
    }
}
