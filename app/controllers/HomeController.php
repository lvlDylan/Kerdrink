<?php

require_once ROOT . "app/models/Product.php";

class HomeController {
    public function index(PDO $db): void
    {
        $productModel = new Product($db);
        $products = $productModel->getLatest();
        $pageTitle = "Bienvenue dans notre cave";
        require_once ROOT . "app/views/products/index.php";
    }
}