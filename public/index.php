<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

if (str_starts_with($_SERVER['SERVER_SOFTWARE'] ?? '', 'PHP')) {
    session_save_path(ROOT . "/tmp/");
}

session_start();

spl_autoload_register(function ($className) {
    $dirs = [
        ROOT . "app" . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR,
        ROOT . "app" . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR
    ];

    foreach ($dirs as $dir) {
        $file = $dir . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

require_once ROOT . "config/database.php";

$db = Database::getInstance();

$page = strtolower($_GET["p"] ?? $_GET["page"] ?? "accueil");

$routes = [
    "accueil" => ["HomeController", "index"],
    "produits" => ["ProductController", "index"],
    "connexion" => ["AuthController", "index"],
    "connexion-exe" => ["AuthController", "login"],
    "deconnexion" => ["AuthController", "logout"],
];

try {

    if (!isset($routes[$page])) {
        throw new Exception("La page " . $page . " n'existe pas.", 404);
    }

    $controllerInfo = $routes[$page];
    $className = $controllerInfo[0];
    $methodName = $controllerInfo[1];

    if (class_exists($className)) {
        $controller = new $className();

        if (method_exists($controller, $methodName)) {
            $controller->$methodName($db);
        } else {
            throw new Exception("La méthode " . $methodName . " n'existe pas.", 500);
        }
    } else {
        throw new Exception("Le contrôleur $className n'existe pas.", 500);
    }
} catch (Exception $e) {
    $code = ($e->getCode() === 404) ? 404 : 500;
    http_response_code($code);
    error_log("Erreur lors du routage : " . $e);

    require_once ROOT . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "404.php";
    exit();
}