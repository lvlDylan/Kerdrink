<?php

class CustomerController
{
    public function index(PDO $db): void
    {
        $customerModel = new Customer($db);
        $customer = $customerModel->getById($_SESSION["user"]["idClient"]);
        $pageTitle = $customer["prenom"] . " - KerDrink";

        ob_start();
        require_once ROOT . "app/views/customer/profile.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }
}