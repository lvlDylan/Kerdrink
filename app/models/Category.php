<?php

readonly class Category
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM categorie ORDER BY idCategorie";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array
    {
        $sql = "SELECT * FROM categorie WHERE idCategorie = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByName(string $name): array
    {
        $sql = "SELECT * FROM categorie WHERE libelleCategorie LIKE :name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => $name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}