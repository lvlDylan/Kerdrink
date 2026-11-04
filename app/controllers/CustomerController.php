<?php

class CustomerController
{
    public function index(PDO $db): void
    {
        $customerModel = new Customer($db);
        $customer = $customerModel->getById($_SESSION["user"]["idClient"]);
        $pageTitle = $customer["prenom"] . " - KerDrink";

        ob_start();
        require_once ROOT . "app/views/customer/profil.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }

    public function export(PDO $db): void
    {
        $customerModel = new Customer($db);
        $customer = $customerModel->getById($_SESSION["user"]["idClient"]);

        /* FAKE SEND DATA TPO CUSTOMER */
        Helper::setFlash("success", "Vos données vous ont été envoyé via l'email enregistré.");

        $pageTitle = $customer["prenom"] . " - KerDrink";
        ob_start();
        require_once ROOT . "app/views/customer/profil.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }

    public function delete(PDO $db): void
    {
        //$customerModel = new Customer($db);
        // $customerModel->delete($_SESSION["user"]["idClient"]); -- FAKE DELETE

        $_SESSION = array();
        Helper::setFlash("success", "Votre compte a été supprimé.");
        header("location: /accueil");
        exit();
    }
}