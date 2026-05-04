<?php

class Helper
{
    public static function setFlash($type, $message): void
    {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];
    }

    public static function getFlash(): array | null
    {
        if (isset($_SESSION["flash"])) {
            $data = $_SESSION["flash"];
            unset($_SESSION["flash"]);
            return $data;
        } else {
            return null;
        }
    }
}