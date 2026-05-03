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

    public function register(): void
    {
        $error = $_GET['error'] ?? null;

        ob_start();
        require_once ROOT . "app/views/auth/register.php";
        $content = ob_get_clean();

        require_once ROOT . "app/views/layout.php";
    }

    #[NoReturn]
    public function registerCustomer(PDO $db): void
    {
        $lastName = $_POST["lastName"] ?? null;
        $firstName = $_POST["firstName"] ?? null;
        $pseudo = $_POST["pseudo"] ?? null;
        $password = $_POST["password"] ?? null;

        $email = $_POST["email"] ?? "";
        $telephone = $_POST["telephone"] ?? "";

        if (empty($lastName) || empty($firstName) || empty($pseudo) || empty($password)) {
            header("location: /?page=inscription&error=empty");
            exit();
        }

        $customerModel = new Customer($db);
        if ($customerModel->register($lastName, $firstName, $pseudo, $password, $email, $telephone)) {
            $customer = $customerModel->getByEmailOrPseudo($pseudo);
            if ($customer) {
                unset($customer["mdp"]);
                $_SESSION["user"] = $customer;
                header("location: /?page=accueil");
            } else {
                header("location: /?page=inscription&error=error");
            }
        } else {
            header("location: /?page=inscription&error=invalid");
        }

        exit();
    }

    #[NoReturn]
    public function login(PDO $db): void {
        $login = $_POST["login"] ?? "";
        $password = $_POST["password"] ?? "";

        $userModel = new User($db);
        $user = $userModel->getByLogin($login);

        if (!$user) {
            $clientModel = new Customer($db);
            $user = $clientModel->getByEmailOrPseudo($login);
        }

        if ($user && $password === $user["mdp"]) {
            unset($user["mdp"]);
            $_SESSION["user"] = $user;
            header("location: /?page=accueil");
        } else {
            header("location: /?page=connexion&error=login");
        }
        exit();
    }

    #[NoReturn]
    public function logout(): void {
        $_SESSION = array();
        session_destroy();
        header("location: /?page=accueil");
        exit();
    }
}