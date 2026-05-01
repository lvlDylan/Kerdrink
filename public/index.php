<?php 
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

spl_autoload_register(function ($className) {
   $file = ROOT . "app" . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . $className . ".php";
   if (file_exists($file)) {
       require_once $file;
   }
});

require_once ROOT . "config/database.php";

$db = Database::getInstance();

$page = strtolower($_GET["p"] ?? $_GET["page"] ?? "accueil");

$routes = [
    "accueil" => ["HomeController", "index"],
    "produits" => ["ProductController", "index"],
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