<?php

readonly class Cart
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCart(int $idClient): array
    {
        $sql = "SELECT produit.nomProduit, produit.prixUnitaire, contenir.numProduit, contenir.quantite, commande.noCommande, commande.dateCommande, commande.idClient, commande.idStatut, statut.libelleStatut
                FROM commande
                LEFT JOIN contenir
                ON commande.noCommande = contenir.noCommande
                LEFT JOIN produit
                ON contenir.numProduit = produit.numProduit
                LEFT JOIN statut
                ON statut.idStatut = commande.idStatut
                WHERE commande.idClient = :idClient AND statut.idStatut = 'PAN'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":idClient" => $idClient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHistory(int $idClient): array
    {
        $sql = "SELECT produit.nomProduit, produit.prixUnitaire, contenir.numProduit, contenir.quantite, commande.noCommande, commande.dateCommande, commande.idClient, commande.idStatut, statut.libelleStatut
                FROM commande
                LEFT JOIN contenir
                ON commande.noCommande = contenir.noCommande
                LEFT JOIN produit
                ON contenir.numProduit = produit.numProduit
                LEFT JOIN statut
                ON statut.idStatut = commande.idStatut
                WHERE commande.idClient = :idClient AND statut.idStatut != 'PAN'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":idClient" => $idClient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByOrderId(int $idClient, int $orderId): array
    {
        $sql = "SELECT * FROM commande WHERE idClient = :idClient AND noCommande = :orderId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":idClient" => $idClient, ":orderId" => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrCreateCart(int $idClient): int
    {
        $sql = "SELECT noCommande FROM commande WHERE idClient = :idClient AND idStatut = 'PAN' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":idClient" => $idClient]);
        $id = $stmt->fetchColumn();

        if ($id) {
            return (int) $id;
        }

        $sqlInsert = "INSERT INTO commande (idClient, idStatut, dateCommande) VALUES (?, 'PAN', NOW())";
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->execute([$idClient]);
        return (int) $this->db->lastInsertId();
    }

    public function addProductToCart(int $orderId, int $productId, int $quantity): void
    {
        $sql = "SELECT quantite FROM contenir WHERE noCommande = :orderId AND numProduit = :productId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["orderId" => $orderId, "productId" => $productId]);
        $existingQty = $stmt->fetchColumn();

        if ($existingQty !== false) {
            $newQty = $existingQty + $quantity;
            $sqlUpd = "UPDATE contenir SET quantite = :quantity WHERE noCommande = :orderId AND numProduit = :productId";
            $stmt = $this->db->prepare($sqlUpd);
            $stmt->execute(["quantity" => $newQty, "orderId" => $orderId, "productId" => $productId]);
        } else {
            $sqlIns = "INSERT INTO contenir (noCommande, numProduit, quantite) VALUES (?, ?, ?)";
            $this->db->prepare($sqlIns)->execute([$orderId, $productId, $quantity]);
        }
    }

    public function removeProductFromCart(int $orderId, int $productId): void
    {
        $sql = "DELETE FROM contenir WHERE noCommande = :orderId AND numProduit = :productId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["orderId" => $orderId, "productId" => $productId]);

        $sqlCount = "SELECT COUNT(*) FROM contenir WHERE noCommande = :orderId";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute(["orderId" => $orderId]);
        $count = $stmtCount->fetchColumn();

        if ($count == 0) {
            $sqlDelete = "DELETE FROM commande WHERE noCommande = :orderId AND idStatut = 'PAN'";
            $stmtDelete = $this->db->prepare($sqlDelete);
            $stmtDelete->execute(["orderId" => $orderId]);
        }
    }

    public function confirmCart(int $orderId): void
    {
        $sql = "UPDATE commande SET idStatut = 'ENC' WHERE noCommande = :orderId AND idStatut = 'PAN'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["orderId" => $orderId]);
    }
}