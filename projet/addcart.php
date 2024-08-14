<?php
require 'Controllers/Database.php';
session_start();
$connected = @$_SESSION["connected"] ; 
if(!$connected){
	header("Location: login.php");
  }
 $produit_id = $_POST["id_produit"];
 $nom_produit = $_POST["nom_produit"];
 $image_produit = $_POST["image_produit"];
 $prix_produit = $_POST["prix_produit"];
 $quantity = intval($_POST["quantity"]);
 $prix = intval($_POST["prix_produit"]);
 $prix_total = $quantity * $prix;
 $db = new Database();
 $conn = $db->getConnection();
 $stmt = $conn->prepare("INSERT INTO cart (produit_id, nom_produit, image_produit, prix_produit, quantity,prix_total,user_id) VALUES (:produit_id, :nom_produit, :image_produit, :prix_produit, :quantity, :prix_total, :user_id)");
 $stmt->bindParam(':produit_id', $produit_id);
 $stmt->bindParam(':nom_produit', $nom_produit);
 $stmt->bindParam(':image_produit', $image_produit);
 $stmt->bindParam(':prix_produit', $prix_produit);
 $stmt->bindParam(':quantity', $quantity);
 $stmt->bindParam(':prix_total', $prix_total);
 $stmt->bindParam(':user_id', $_SESSION["client_id"]);

 $stmt->execute();
 echo "<script>window.location.href='CartPage.php'</script>";
