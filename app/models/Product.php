<?php

class Product
{
    private readonly PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getLatest()
    {
        $sql = "SELECT * FROM produit ORDER BY numProduit DESC LIMIT 6";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() 
    {
        $sql = "SELECT * FROM produit ORDER BY numProduit DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getbyId(int $id)
    {
        $sql = "SELECT * FROM produit WHERE numProduit = $id";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}
