<?php

class GeneralController {
    public function legal(PDO $db):void
    {
        ob_start();
        require_once ROOT . "app/views/general/legal.php";
        $content = ob_get_clean();
        require_once ROOT . "app/views/layout.php";
    }
}