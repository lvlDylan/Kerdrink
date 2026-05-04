<?php

use JetBrains\PhpStorm\NoReturn;

class AuthController {

    public function index(): void
    {
        ob_start();
        require_once ROOT . "app/views/auth/login.php";
        $content = ob_get_clean();

        require_once ROOT . "app/views/layout.php";
    }

    public function register(): void
    {
        ob_start();
        require_once ROOT . "app/views/auth/register.php";
        $content = ob_get_clean();

        require_once ROOT . "app/views/layout.php";
    }

    public function registerCustomer(PDO $db): void
    {
        $lastName = $_POST["lastName"] ?? null;
        $firstName = $_POST["firstName"] ?? null;
        $pseudo = $_POST["pseudo"] ?? null;
        $password = $_POST["password"] ?? null;

        $email = !empty($_POST["email"]) ? $_POST["email"] : null;
        $telephone = !empty($_POST["telephone"]) ? $_POST["telephone"] : null;

        if (empty($lastName) || empty($firstName) || empty($pseudo) || empty($password)) {
            Helper::setFlash("error", "Veuillez remplir les champs requis.");
            header("location: /inscription");
            exit();
        }

        $customerModel = new Customer($db);
        if ($customerModel->register($lastName, $firstName, $pseudo, $password, $email, $telephone)) {
            $customer = $customerModel->getByPseudo($pseudo);
            if ($customer) {
                unset($customer["mdp"]);
                $_SESSION["user"] = $customer;
                header("location: /accueil");
                exit();
            } else {
                Helper::setFlash("error", "Une erreur est survenue lors de la création de votre compte.");
                header("location: /inscription");
                exit();
            }
        } else {
            Helper::setFlash("error", "Ce courriel ou ce pseudonyme n'est pas disponible.");
            header("location: /inscription");
            exit();
        }
    }

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
            header("location: /accueil");
        } else {
            Helper::setFlash("error", "Vos identifiants sont invalides.");
            header("location: /connexion");
        }
        exit();
    }

    public function logout(): void {
        $_SESSION = array();
        session_destroy();
        header("location: /accueil");
        exit();
    }
}