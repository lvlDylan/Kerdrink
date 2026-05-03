<?php

class ProductController {
    public function index(PDO $db): void
    {
        $productModel = new Product($db);
        $products = $productModel->getAll();
        $pageTitle = "Découvrez notre gamme";
        ob_start();
        require_once ROOT . "app/views/products/index.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }
}