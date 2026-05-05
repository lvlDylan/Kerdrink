<?php

readonly class Order {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT 
                c.noCommande, 
                c.dateCommande, 
                c.idClient, 
                s.libelleStatut,
                cl.nom,
                cl.prenom,
                SUM(co.quantite * p.prixUnitaire) as totalCommande
                FROM commande c
                JOIN statut s ON s.idStatut = c.idStatut
                JOIN client cl ON c.idClient = cl.idClient
                LEFT JOIN contenir co ON c.noCommande = co.noCommande
                LEFT JOIN produit p ON co.numProduit = p.numProduit
                WHERE s.idStatut = 'ENC'
                GROUP BY 
                c.noCommande, 
                c.dateCommande,
                c.idClient, 
                s.libelleStatut,
                cl.nom,
                cl.prenom
                ORDER BY c.dateCommande DESC;";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrder(int $id): array
    {
        $sqlInfo = "SELECT c.*, cl.nom, cl.prenom, s.libelleStatut 
        FROM commande c
        JOIN client cl ON c.idClient = cl.idClient
        JOIN statut s ON s.idStatut = c.idStatut
        WHERE c.noCommande = :orderId";
        $stmtInfo = $this->db->prepare($sqlInfo);
        $stmtInfo->execute(["orderId" => $id]);
        $orderInfo = $stmtInfo->fetch(PDO::FETCH_ASSOC);

        $sqlContains = "SELECT p.nomProduit, p.prixUnitaire, co.quantite
        FROM contenir co
        JOIN produit p ON co.numProduit = p.numProduit
        WHERE co.noCommande = :orderId";
        $stmtContains = $this->db->prepare($sqlContains);
        $stmtContains->execute(["orderId" => $id]);
        $orderContains = $stmtContains->fetchAll(PDO::FETCH_ASSOC);

        return [
            "orderInfo" => $orderInfo,
            "contains" => $orderContains
        ];
    }

    public function send(int $orderId): bool
    {
        $sql = "UPDATE commande SET idStatut = 'ENV' WHERE noCommande = :orderId;";
        return $this->db->prepare($sql)->execute(["orderId" => $orderId]);
    }
}
