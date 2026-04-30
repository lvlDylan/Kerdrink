<?php 
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require_once ROOT . "config/database.php";

$db = Database::getInstance();

$page = $_GET["p"] ?? "accueil";

$routes = [
    "accueil" => ["HomeController", "index"],
    "produits" => ["ProduitsController", "index"],
];

try {
    $controllerInfo = $routes[$page] ?? $routes["accueil"];
    $className = $controllerInfo[0];
    $methodName = $controllerInfo[1];

    if (class_exists($className)) {
        $controller = new $className();
        $controller->$methodName($db);
    } else {
        throw new Exception("Le contrôleur $className n'existe pas.");
    }
} catch (Exception $e) {
    http_response_code(404);
    error_log("Erreur lors du routage : " . $e);
    die("Oups cette page n'existe pas.");
}