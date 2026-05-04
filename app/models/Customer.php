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
        $stmt->execute(['mail' => $pseudo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmailOrPseudo(string $login): array | false
    {
        $sql = "SELECT * FROM client WHERE (pseudo = :pseudo OR mail = :mail);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['pseudo' => $login, 'mail' => $login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register(string $lastName, string $firstName, string $pseudo, string $password, ?string $email, ?string $telephone): bool
    {

        $sqlExist = " SELECT pseudo FROM client WHERE pseudo = :pseudo OR (:mail IS NOT NULL AND mail = :mail)";
        $stmtExist = $this->db->prepare($sqlExist);
        $stmtExist->bindValue(':pseudo', $pseudo);
        $stmtExist->bindValue(':email', $email);
        $stmtExist->execute();
        if ($stmtExist->fetchColumn()) {
            return false;
        }

        $sql = "INSERT INTO client (nom, prenom, pseudo, mdp, mail, telephone) VALUES (:nom, :prenom, :pseudo, :mdp, :mail, :telephone)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $lastName);
        $stmt->bindValue(':prenom', $firstName);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':mdp', $password);
        $stmt->bindValue(':mail', $email, $email === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':telephone', $telephone, $telephone === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}
