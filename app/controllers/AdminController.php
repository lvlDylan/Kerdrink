<?php

class AdminController
{
    public function index(PDO $db): void
    {
        $userModel = new User($db);
        $clientModel = new Customer($db);
        $users = $userModel->getAll();
        $clients = $clientModel->getAll();

        ob_start();
        $content = require_once ROOT . "app/views/admin/index.php";
        $content = ob_get_clean();

        require_once ROOT . "app/views/layout.php";
    }
}