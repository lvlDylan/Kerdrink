<?php

class CustomerController
{
    public function index(PDO $db): void
    {
        $customerModel = new Customer($db);
        $customer = Helper::uncipher_user($customerModel->getById($_SESSION["user"]["idClient"]));
        $pageTitle = $customer["prenom"] . " - KerDrink";

        ob_start();
        require_once ROOT . "app/views/customer/profil.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }

    /**
     * @author Dylan Lavieille
     * @param PDO $db Instance du PDO associé à l'application
     * @return void
     * 
     * Cette fonction envoie un fichier JSON à l'utilisateur contenant ses données en base.
     */
    public function export(PDO $db): void
    {
        $customerModel = new Customer($db);
        $customer = $customerModel->getById($_SESSION["user"]["idClient"]);
        $addresses = $customerModel->getAddresses($customer["idClient"]);


        $customerData = [
            "Nom" => $customer["nom"],
            "Prenom" => $customer["prenom"],
            "Pseudo" => $customer["pseudo"],
            "Courriel" => $customer["mail"] ?? "Aucun courriel renseigné.",
            "Téléphone" => $customer["telephone"] ?? "Aucun téléphone renseigné",
            "Addresses" => $addresses
        ];


        $json = json_encode($customerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $fileName = "export_" . time() . ".json";
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Connection: close');
        echo $json;
        exit;
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
