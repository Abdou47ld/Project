<?php

require 'Database.php';

class Produit {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getProduits() {
        $conn = $this->db->getConnection();
        $stmt = $conn->query("SELECT * FROM produits");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterProduit($produit) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO produits (nom_produit, description_produit, image_produit, prix_produit, categorie_produit) VALUES (:nom_produit, :description_produit, :image_produit, :prix_produit, :categorie_produit)");
        $stmt->bindParam(':nom_produit', $produit->getNomProduit());
        $stmt->bindParam(':description_produit', $produit->getDescriptionProduit());
        $stmt->bindParam(':image_produit', $produit->getImageProduit());
        $stmt->bindParam(':prix_produit', $produit->getPrixProduit());
        $stmt->bindParam(':categorie_produit', $produit->getCategorieProduit());
        return $stmt->execute();

    }

    public function getProduitsByCat($cat) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM produits WHERE categorie_produit = :cat");
        $stmt->bindParam(':cat', $cat);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitByID($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateProduit($id, $nom_produit, $description_produit, $prix_produit, $categorie_produit) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE produits SET nom_produit = :nom_produit, description_produit = :description_produit, prix_produit = :prix_produit, categorie_produit = :categorie_produit WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom_produit', $nom_produit);
        $stmt->bindParam(':description_produit', $description_produit);
        $stmt->bindParam(':prix_produit', $prix_produit);
        $stmt->bindParam(':categorie_produit', $categorie_produit);
        return $stmt->execute();
    }

    public function supprimerProduit($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
