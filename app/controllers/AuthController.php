<?php

use JetBrains\PhpStorm\NoReturn;

class AuthController {

    public function index(): void
    {
        $error = $_GET['error'] ?? null;

        ob_start();
        require_once ROOT . "app/views/auth/login.php";
        $content = ob_get_clean();

        require_once ROOT . "app/views/layout.php";
    }

    #[NoReturn]
    public static function login(PDO $db): void {
        $login = $_POST["login"] ?? "";
        $password = $_POST["password"] ?? "";

        $userModel = new User($db);
        $user = $userModel->getByLogin($login);

        if (!$user) {
            $clientModel = new Client($db);
            $user = $clientModel->getByEmailOrPseudo($login);
        }

        if ($user && $password === $user["mdp"]) {
            unset($user["mdp"]);
            $_SESSION["user"] = $user;
            header("location: /?p=accueil");
        } else {
            header("location: /?p=connexion&error=login");
        }
        exit();
    }

    #[NoReturn]
    public static function logout(): void {
        $_SESSION = array();
        session_destroy();
        header("location: /?p=accueil");
        exit();
    }
}