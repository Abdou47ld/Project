<?php
require 'Controllers/Commande.php';
require 'Controllers/Produit.php';
error_reporting(E_ALL ^ E_NOTICE);  

session_start();

$connected = @$_SESSION["admin_connected"] ; 
if(!$connected){
	header("Location: login.php");
  }
$id = @$_GET["numcommande"];
$commande = new Commande();
$commande->livrerCommande($id);
echo "<script>alert('Order est considéré comme Livrée !');</script>";
echo "<script>window.location.href='mesorders.php'</script>";


?>