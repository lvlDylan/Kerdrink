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
}
