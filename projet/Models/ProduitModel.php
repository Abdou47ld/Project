<?php

class ProduitModel {
    private $nom_produit;
    private $description_produit;
    private $image_produit;
    private $prix_produit;
    private $categorie_produit;

    public function __construct($nom_produit, $description_produit, $image_produit, $prix_produit, $categorie_produit) {
        $this->nom_produit = $nom_produit;
        $this->description_produit = $description_produit;
        $this->image_produit = $image_produit;
        $this->prix_produit = $prix_produit;
        $this->categorie_produit = $categorie_produit;
    }

    public function getNomProduit() {
        return $this->nom_produit;
    }

    public function setNomProduit($nom_produit) {
        $this->nom_produit = $nom_produit;
    }

    public function getDescriptionProduit() {
        return $this->description_produit;
    }

    public function setDescriptionProduit($description_produit) {
        $this->description_produit = $description_produit;
    }

    public function getImageProduit() {
        return $this->image_produit;
    }

    public function setImageProduit($image_produit) {
        $this->image_produit = $image_produit;
    }

    public function getPrixProduit() {
        return $this->prix_produit;
    }

    public function setPrixProduit($prix_produit) {
        $this->prix_produit = $prix_produit;
    }

    public function getCategorieProduit() {
        return $this->categorie_produit;
    }

    public function setCategorieProduit($categorie_produit) {
        $this->categorie_produit = $categorie_produit;
    }
}

?>
