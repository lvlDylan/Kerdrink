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

    /**
     * @author Dylan
     * @param string $password Mot de passe en clair
     * @return string hash du mot de passe
     */
    public static function hash_password(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    /**
     * @author Dylan Lavieille
     * @param string $data Données à chiffre
     * @return string Données chiffrées
     */
    public static function cipher_text(?string $data): ?string
    {
        if ($data == null)
            return null;
        
        $ivLength = openssl_cipher_iv_length($_ENV["CIPHER_METHOD"]);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $cipher = openssl_encrypt($data, $_ENV["CIPHER_METHOD"], $_ENV["CIPHER_KEY"], OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $cipher);
    }

    /**
     * @author Dylan Lavieille
     * @param string $data Données à déchiffrer
     * @return string Données déchiffré.
     */
    public static function uncipher_data(string $data): string
    {
        $decode = base64_decode($data);

        $ivLength = openssl_cipher_iv_length($_ENV["CIPHER_METHOD"]);
        $iv = substr($decode, 0, $ivLength);
        $text = substr($decode, $ivLength);
        return openssl_decrypt($text, $_ENV["CIPHER_METHOD"], $_ENV["CIPHER_KEY"], OPENSSL_RAW_DATA, $iv);
    }

    public static function uncipher_user(array $user): ?array {
        if (!$user)
            return null;

        $user["prenom"] = $user["prenom"] != null ? self::uncipher_data($user["prenom"]) : $user["prenom"];
        $user["nom"] = $user["nom"] != null ? self::uncipher_data($user["nom"]) : $user["nom"];
        return $user;
    }
}