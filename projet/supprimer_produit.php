<?php
session_start();
require "Controllers/Produit.php";
$connected = @$_SESSION["admin_connected"] ; 
if(!$connected){
	header("Location: index.php");
  }
  $id = @$_GET["id"];
  $produit = new Produit();
  $article = $produit->getProduitByID($id);
  
if(! $article){
   header("Location:mesproduits.php");
}

 $produit->supprimerProduit($id);
 echo "<script>alert('Invalid email or password');</script>";
 header("Location:mesproduits.php");

?>