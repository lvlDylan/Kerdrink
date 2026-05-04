<?php

use JetBrains\PhpStorm\NoReturn;

class CartController
{

    private function getOrders(array $data): array
    {
        $orders = [];
        foreach ($data as $row) {
            $idCmd = $row["noCommande"];
            if (!isset($orders[$idCmd])) {
                $orders[$idCmd] = [
                    'date' => $row['dateCommande'],
                    'statut' => $row['libelleStatut'],
                    'idStatut' => $row["idStatut"],
                    'produits' => []
                ];
            }

            $orders[$idCmd]['produits'][] = [
                'nom' => $row['nomProduit'],
                'prix' => $row['prixUnitaire'],
                'qte' => $row['quantite']
            ];
        }
        return $orders;
    }
    public function index(PDO $db): void
    {
        $customerModel = new Customer($db);
        $cartModel = new Cart($db);
        $customer = $customerModel->getById($_SESSION["user"]["idClient"]);

        $rows = $cartModel->getCart($customer["idClient"]);

        $cart = [
            'noCommande' => $rows[0]['noCommande'] ?? null,
            'date' => $rows[0]['dateCommande'] ?? null,
            'idStatut' => $rows[0]['idStatut'] ?? null,
            'statut' => $rows[0]['libelleStatut'] ?? null,
            'produits' => []
        ];

        foreach ($rows as $row) {
            $cart['produits'][] = [
                'numProduit' => $row['numProduit'],
                'nom' => $row['nomProduit'],
                'prix' => $row['prixUnitaire'],
                'qte' => $row['quantite']
            ];
        }

        $pageTitle = "Mon Panier - KerDrink";
        ob_start();
        require_once ROOT . "app/views/customer/cart.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }
    public function history(PDO $db): void
    {
        $customerModel = new Customer($db);
        $cartModel = new Cart($db);
        $customer = $customerModel->getById($_SESSION["user"]["idClient"]);


        $rows = $cartModel->getHistory($customer["idClient"]);
        $orders = $this->getOrders($rows);

        $pageTitle = $customer["prenom"] . " - KerDrink";

        ob_start();
        require_once ROOT . "app/views/customer/history.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }

    public function add(PDO $db): void
    {
        $idClient = $_SESSION["user"]["idClient"];
        $productId = (int) $_POST["id"];
        $qty = (int) ($_POST["qty"] ?? 1);

        $cartModel = new Cart($db);

        $orderId = $cartModel->getOrCreateCart($idClient);
        $cartModel->addProductToCart($orderId, $productId, $qty);
        header("location: /?page=panier");
        exit();
    }

    public function remove(PDO $db): void
    {
        $idClient = $_SESSION["user"]["idClient"];
        $productId = (int) $_POST["id"];
        $cartModel = new Cart($db);
        $orderId = $cartModel->getOrCreateCart($idClient);
        $cartModel->removeProductFromCart($orderId, $productId);
        header("location: /?page=panier");
        exit();
    }
    public function confirm(PDO $db): void
    {
        $idClient = $_SESSION["user"]["idClient"];
        $cartModel = new Cart($db);
        $orderId = $cartModel->getOrCreateCart($idClient);
        $cartModel->confirmCart($orderId);
        header("location: /?page=historique&message=orderSuccess");
    }
}
