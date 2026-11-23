<?php

use JetBrains\PhpStorm\NoReturn;

class AuthController
{

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

    /**
    * Vérifie que toutes les informations saisies par l'utilisateur sont valides.
    *
    * Vérifie la longueur du nom, du prénom, du pseudo et du mot de passe,
    * ainsi que le format de l'adresse email et du numéro de téléphone.
    *
    * @param string $lastName Nom de l'utilisateur (32 caractères maximum).
    * @param string $firstName Prénom de l'utilisateur (32 caractères maximum).
    * @param string $pseudo Pseudo de l'utilisateur (entre 4 et 32 caractères).
    * @param string $password Mot de passe de l'utilisateur (8 caractères minimum).
    * @param null|string $email Adresse email de l'utilisateur.
    * @param null|string $telephone Numéro de téléphone français (10 chiffres).
    *
    * @return ?string Message de l'erreur
    */
    private function validateInformations(string $lastName, string $firstName, string $pseudo, string $password, ?string $email, ?string $telephone): ?string
    {
        if (strlen($lastName) > 32) {
            return "Le nom ne peut pas dépasser 32 caractères.";
        }

        if (strlen($firstName) > 32) {
            return "Le prénom ne peut pas dépasser 32 caractères.";
        }
        
        if (strlen($pseudo) < 4 || strlen($pseudo) > 32) {
            return "Le pseudo ne peut être plus petit que 4 caractères ou ne pas dépasser 32 caractères.";
        }

        if (strlen($password) < 12 || strlen($password) > 32) {
            return "Le mot de passe ne peut être plus petit que 12 caractères ou ne pas dépasser 32 caractères.";
        }

        if ($email != false && filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            return "L'email est invalide.";

        $regex = '/^0[1-9](?:[0-9]{8})$/';
        if ($telephone != null && !preg_match($regex, $telephone))
            return "Le telephone est invalide.";

        return null;
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

        $errorMessage = $this->validateInformations($lastName, $firstName, $pseudo, $password, $email, $telephone);

        if ($errorMessage) {
            Helper::setFlash("error", $errorMessage);
            header("location: /inscription");
            exit;
        }

        $customerModel = new Customer($db);


        if ($customerModel->register($lastName, $firstName, $pseudo, $password, $email, $telephone)) {
            $customer = $customerModel->getByPseudo($pseudo);
            if ($customer) {
                unset($customer["pass_hash"]);
                $_SESSION["user"] = $customer;
                header("location: /accueil");
            } else {
                Helper::setFlash("error", "Une erreur est survenue lors de la création de votre compte.");
                header("location: /inscription");
            }
        } else {
            Helper::setFlash("error", "Ce courriel ou ce pseudonyme n'est pas disponible.");
            header("location: /inscription");
        }
        exit();
    }

    public function login(PDO $db): void
    {
        $login = $_POST["login"] ?? "";
        $password = $_POST["password"] ?? "";

        $userModel = new User($db);
        $user = $userModel->getByLogin($login);

        if (!$user) {
            $clientModel = new Customer($db);
            $user = $clientModel->getByEmailOrPseudo($login);
        }

        if ($user) {
            if (password_verify($password, $user["pass_hash"])) {
                Logger::log(LogLevel::INFO, "AuthController.php(login)", $_SERVER["REMOTE_ADDR"] . " s'est conneté sur le compte (" . $login . ").");
                $_SESSION["user"] = Helper::uncipher_user($user);
                header("location: /accueil");
                exit();
            }
        }

        Logger::log(LogLevel::WARN, "AuthController.php(login)", $_SERVER["REMOTE_ADDR"] . " a essayé de se connecter avec (" . $login . ").");
        Helper::setFlash("error", "Vos identifiants sont invalides.");
        header("location: /connexion");
        exit();
    }

    public function logout(): void
    {
        $_SESSION = array();
        session_destroy();
        header("location: /accueil");
        exit();
    }
}
