<?php 
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require_once ROOT . "config/database.php";

$db = Database::getInstance();

$page = $_GET["p"] ?? "accueil";

try {
    match ($page) {
        "accueil" => (function () use ($db) {
            require_once ROOT . "app/controllers/HomeController.php";
            (new HomeController())->index($db);
        })(),
        default => (function() use ($db) {
            require_once ROOT . "app/controllers/HomeController.php";
            (new HomeController())->index($db);
        })()
    };
} catch (Exception $e) {
    http_response_code(404);
    error_log("Erreur lors du routage : " . $e);
    die("La page demandé n'existe pas.");
}