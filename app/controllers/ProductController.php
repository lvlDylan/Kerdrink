<?php

class ProductController {
    public function index(PDO $db): void
    {
        $productModel = new Product($db);
        $products = $productModel->getAll();
        $pageTitle = "Découvrez notre gamme";
        require_once ROOT . "app/views/products/index.php";
    }
}