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

    public function register(string $lastName, string $firstName, string $pseudo, ?string $email, ?string $telephone): bool
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

        $sql = "INSERT INTO client (nom, prenom, pseudo, mdp_hash, salt, mail, telephone) VALUES (:nom, :prenom, :pseudo, :mail, :telephone)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $lastName);
        $stmt->bindValue(':prenom', $firstName);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':mail', $email, $email === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':telephone', $telephone, $telephone === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}
