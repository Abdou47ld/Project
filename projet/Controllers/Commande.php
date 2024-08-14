<?php


class Commande {
    private $db;
//cree une connection (Database.php)
    public function __construct() {
        $this->db = new Database();
    }
//obtenir toutes les commandes des tables de commandes
    public function getCommandes() {
        $conn = $this->db->getConnection();
        $stmt = $conn->query("SELECT * FROM commandes ORDER BY livred ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //ramener des commandes dun client par son  id 
    public function getCommandesByClient($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM commandes WHERE user_id = :id ORDER BY livred ASC");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //ajouter les commandes dans la table de commande 
    public function ajouterCommande($commande) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO commandes (nom, adress, codepostal, tel, quantite, prix_total, user_id, produit_id, livred) VALUES (:nom, :adress, :codepostal, :tel, :quantite, :prix_total, :user_id, :produit_id, :livred)");
        $stmt->bindParam(':nom', $commande->getNom());
        $stmt->bindParam(':adress', $commande->getAdress());
        $stmt->bindParam(':codepostal', $commande->getCodepostal());
        $stmt->bindParam(':tel', $commande->getTel());
        $stmt->bindParam(':quantite', $commande->getQuantite());
        $stmt->bindParam(':prix_total', $commande->getPrixTotal());
        $stmt->bindParam(':user_id', $commande->getUserId());
        $stmt->bindParam(':produit_id', $commande->getProduitId());
        $stmt->bindParam(':livred', $commande->getLivred());
        return $stmt->execute();
    }
//chnager le statuts de commande a livrer 
    public function livrerCommande($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE commandes SET livred = 2 WHERE commande_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
