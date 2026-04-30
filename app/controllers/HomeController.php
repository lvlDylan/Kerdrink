<?php

require_once ROOT . "app/models/Product.php";

class HomeController {
    public function index(PDO $db) {
        $productModel = new Product($db);
        $products = $productModel->getLatest();
        require_once ROOT . "app/views/home.php";
    }
}