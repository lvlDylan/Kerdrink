<?php
class Database
{
    private function __construct() {}
    private function __clone() {}

    private const string DB_HOST = "localhost";
    private const string DB_USER = "myroot";
    private const string DB_PASSWORD = "root123*";

    private const string DB_NAME = "dl_kerdrink";

    private static PDO | null $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            try {
                $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=utf8";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$instance = new PDO($dsn, self::DB_USER, self::DB_PASSWORD, $options);
            } catch (PDOException $e) {
                error_log($e);
                die("Erreur lors de l'instanciation de la base de données.");
            }
        }

        return self::$instance;
    }
}
