<?php

class AdminController
{
    public function index(PDO $db): void
    {
        $userModel = new User($db);
        $clientModel = new Customer($db);
        $orderModel = new Order($db);
        $users = $userModel->getAll();
        $clients = $clientModel->getAll();
        $orders = $orderModel->getAll();

        ob_start();
        $content = require_once ROOT . "app/views/admin/index.php";
        $content = ob_get_clean();

        require_once ROOT . "app/views/layout.php";
    }

    public function orderDetail(PDO $db): void
    {
        $id = $_GET["id"] ?? null;
        if (!$id) {
            Helper::setFlash("error", "Aucune commande avec ce numéro a été trouvé !");
            header("Location: /admin");
            exit();
        }

        $orderModel = new Order($db);
        $data = $orderModel->getOrder($id);
        if (empty($data["orderInfo"]) && empty($data["contains"][0])) {
            Helper::setFlash("error", "Cette commande semble compter une erreur...");
            header("Location: /admin");
            exit();
        }

        $orderInfo = $data["orderInfo"];
        $contains = $data["contains"];

        $pageTitle = "Commande #" . $orderInfo["noCommande"];
        ob_start();
        require_once ROOT . "app/views/admin/detail.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }

    public function updateStatut(PDO $db): void
    {
        $orderModel = new Order($db);
        $orderId = $_POST["noCommande"];
        if ($orderModel->send($orderId))
        {
            Helper::setFlash("success", "La commande a été expédié !");
        } else {
            Helper::setFlash("error", "Une erreur est survenue lors de la préparation de la commande.");
        }

        header("Location: /admin");
        exit();
    }
}