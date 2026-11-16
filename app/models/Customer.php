<?php

readonly class Customer
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getById(int $id): array
    {
        $sql = "SELECT * FROM client WHERE idClient = :id;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM client;";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail(string $email): array | false
    {
        $sql = "SELECT * FROM client WHERE mail = :mail;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['mail' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByPseudo(string $pseudo): array | false
    {
        $sql = "SELECT * FROM client WHERE pseudo = :pseudo;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmailOrPseudo(string $login): array | false
    {
        $sql = "SELECT * FROM client WHERE (pseudo = :pseudo OR mail = :mail);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['pseudo' => $login, 'mail' => $login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAddresses(string $customerId): array | false
    {
        $sql = "SELECT adresse.rue, adresse.codePostal, adresse.ville FROM adresse JOIN habiter ON adresse.idAdresse = habiter.idAdresse WHERE habiter.idClient = :idClient";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['idClient' => $customerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Enregistre un nouveau client dans la base de données.
     *
     * Vérifie au préalable que le pseudo et, si elle est renseignée, l'adresse
     * e-mail ne sont pas déjà utilisés. Les informations personnelles sont
     * chiffrées avant leur insertion et le mot de passe est haché.
     *
     * @param string      $lastName  Nom du client.
     * @param string      $firstName Prénom du client.
     * @param string      $pseudo    Pseudonyme du client.
     * @param string      $password  Mot de passe du client (sera haché).
     * @param string|null $email     Adresse e-mail du client (facultative).
     * @param string|null $telephone Numéro de téléphone du client (facultatif).
     *
     * @return bool Retourne true si le client a été enregistré,
     *              false si le pseudo ou l'adresse e-mail existe déjà.
     */
    public function register(string $lastName, string $firstName, string $pseudo, string $password, ?string $email, ?string $telephone): bool
    {
        if ($email != null) {
            $sqlExist = " SELECT pseudo FROM client WHERE pseudo = :pseudo OR mail = :mail";
        } else {
            $sqlExist = " SELECT pseudo FROM client WHERE pseudo = :pseudo";
        }
        $stmtExist = $this->db->prepare($sqlExist);
        $stmtExist->bindValue(':pseudo', $pseudo);

        if ($email != null) {
            $stmtExist->bindValue(':mail', $email);
        }

        $stmtExist->execute();
        if ($stmtExist->fetchColumn()) {
            return false;
        }

        $sql = "INSERT INTO client (nom, prenom, pseudo, pass_hash, mail, telephone) VALUES (:nom, :prenom, :pseudo, :pass_hash, :mail, :telephone)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', Helper::cipher_text($lastName));
        $stmt->bindValue(':prenom', Helper::cipher_text($firstName));
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':pass_hash', Helper::hash_password($password));
        $stmt->bindValue(':mail', $email, $email === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':telephone', Helper::cipher_text($telephone), $telephone === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}
