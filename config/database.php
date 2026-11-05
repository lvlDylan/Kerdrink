<?php
class Database
{
    /**
     * Ces fonctions permettent de pas pouvoir instancier ou cloner la classe, elle se doit d'être statique (singleton).
     */
    private function __construct() {}
    private function __clone() {}

    /**
     * @var ?PDO $instance - Instance d'un PDO
     */
    private static PDO | null $instance = null;

    /**
     * @author Dylan
     * @return ?PDO L'instance active de la connexion PDO
     */
    public static function getInstance(): ?PDO
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
