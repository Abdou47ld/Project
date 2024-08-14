<?php

class CommandeModel {
    private $nom;
    private $adress;
    private $codepostal;
    private $tel;
    private $quantite;
    private $prix_total;
    private $user_id;
    private $produit_id;
    private $livred;

    public function __construct($nom, $adress, $codepostal, $tel, $quantite, $prix_total, $user_id, $produit_id, $livred) {
        $this->nom = $nom;
        $this->adress = $adress;
        $this->codepostal = $codepostal;
        $this->tel = $tel;
        $this->quantite = $quantite;
        $this->prix_total = $prix_total;
        $this->user_id = $user_id;
        $this->produit_id = $produit_id;
        $this->livred = $livred;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getAdress() {
        return $this->adress;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
    }

    public function getCodepostal() {
        return $this->codepostal;
    }

    public function setCodepostal($codepostal) {
        $this->codepostal = $codepostal;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function getPrixTotal() {
        return $this->prix_total;
    }

    public function setPrixTotal($prix_total) {
        $this->prix_total = $prix_total;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getProduitId() {
        return $this->produit_id;
    }

    public function setProduitId($produit_id) {
        $this->produit_id = $produit_id;
    }

    public function getLivred() {
        return $this->livred;
    }

    public function setLivred($livred) {
        $this->livred = $livred;
    }
}
?>
