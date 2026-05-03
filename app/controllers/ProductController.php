<?php

class ProductController {
    public function index(PDO $db): void
    {
        $productModel = new Product($db);
        $products = $productModel->getAll();
        $pageTitle = "Découvrez notre gamme - KerDrink";
        ob_start();
        require_once ROOT . "app/views/products/index.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }

    public function detail(PDO $db): void
    {
        $productModel = new Product($db);
        $categoryModel = new Category($db);
        $id = $_GET["id"] ?? "1";
        $product = $productModel->getById($id);
        $category = $categoryModel->getById($product["idCategorie"]);
        $pageTitle = $product["nomProduit"] . " - KerDrink";
        ob_start();
        require_once ROOT . "app/views/products/detail.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }
}