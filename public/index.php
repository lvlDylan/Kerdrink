<?php
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

require_once ROOT . 'config/Logger.php';

require_once ROOT . 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

if (str_starts_with($_SERVER['SERVER_SOFTWARE'] ?? '', 'PHP')) {
    session_save_path(ROOT . "/tmp/");
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['age_verify'])) {
    $_SESSION['is_major'] = true;
}

define('IS_MAJOR', $_SESSION['is_major'] ?? false);

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

require_once ROOT . "app" . DIRECTORY_SEPARATOR . "Helper.php";
require_once ROOT . "config" . DIRECTORY_SEPARATOR . "database.php";

$db = Database::getInstance();

$request = $_GET['p'] ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = trim($request, '/');

$parts = explode('/', $request);
$page = !empty($parts[0]) ? strtolower($parts[0]) : "accueil";
$_SESSION['current_page'] = $page;

if ($page === 'produits' && isset($parts[1]) && $parts[1] === 'detail') { // /produits/detail/1
    $page = 'produits-detail';

    if (isset($parts[2])) {
        $_GET['id'] = $parts[2];
    }
}

if ($page === 'admin' && isset($parts[1]) && $parts[1] === 'orders') { // /admin/orders/detail/1
    $page = 'admin-orders';

    if (isset($parts[3])) {
        $_GET['id'] = $parts[3];
    }
}

$routes = [
    "accueil" => ["HomeController", "index"],
    "legal" => ["GeneralController", "legal"],
    "produits" => ["ProductController", "index"],
    "produits-detail" => ["ProductController", "detail"],
    "connexion" => ["AuthController", "index"],
    "inscription" => ["AuthController", "register"],
    "admin" => ["AdminController", "index", "admin"],
    "admin-orders" => ["AdminController", "orderDetail", "admin"],
    "admin-update-statut-exe" => ["AdminController", "updateStatut", "admin"],
    "profil" => ["CustomerController", "index", "client"],
    "exporter-donnees" => ["CustomerController", "export", "client"],
    "supprimer-compte" => ["CustomerController", "delete", "client"],
    "historique" => ["CartController", "history", "client"],
    "panier" => ["CartController", "index", "client"],
    "ajouter-panier-exe" => ["CartController", "add", "client"],
    "retirer-panier-exe" => ["CartController", "remove", "client"],
    "valider-panier-exe" => ["CartController", "confirm", "client"],
    "connexion-exe" => ["AuthController", "login"],
    "inscription-exe" => ["AuthController", "registerCustomer"],
    "deconnexion-exe" => ["AuthController", "logout"],
];

try {

    if (!isset($routes[$page])) {
        throw new Exception("La page " . $page . " n'existe pas.", 404);
    }

    $controllerInfo = $routes[$page];

    if ($controllerInfo && !empty($controllerInfo[2])) {
        if (!isset($_SESSION["user"])) {
            Helper::setFlash("error", "Vous devez être connecté pour accéder à ce contenu.");
            header("location: /connexion");
            exit();
        }

        if ($controllerInfo[2] === "admin") {
            if (!isset($_SESSION["user"]["role"]) || $_SESSION["user"]["role"] !== "adm") {
                Helper::setFlash("error", "Vous devez être authentifié pour accéder à ce contenu.");
                header("location: /accueil");
                exit();
            }
        }

        if ($controllerInfo[2] === "client") {
            if (!isset($_SESSION["user"]["idClient"])) {
                Helper::setFlash("error", "Vous devez être connecté en tant que client pour accéder à ce contenu.");
                header("location: /connexion");
                exit();
            }
        }
    }

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
    Logger::log(LogLevel::ERROR, "index.php(routage)", "Erreur lors du routage : " . $e);

    $pageTitle = "KerDrink - Erreur " . $code;

    ob_start();
    require_once ROOT . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "404.php";
    $content = ob_get_clean();
    require_once ROOT . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "layout.php";
    exit();
}