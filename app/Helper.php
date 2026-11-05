<?php

class Helper
{
    public static function setFlash(string $type, string $message): void
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

    public static function hash_password(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
}