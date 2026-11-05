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

    public static function genSalt(): string
    {
        try
        {
            $bytes = random_bytes(8);
            return bin2hex($bytes);
        } catch (\Random\RandomException $ex)
        {
            error_log($ex->getMessage());
            return "";
        }
    }

    public static function getHash(string $salt, string $password): string
    {
        return hash("sha256", $password . $salt);
    }
}