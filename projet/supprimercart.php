<?php
error_reporting(E_ALL ^ E_NOTICE);  
require 'Controllers/Database.php';
session_start();

$connected = @$_SESSION["connected"] ; 
$db = new Database();
$conn = $db->getConnection();
$id = $_GET["id"];
$stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
echo "<script>window.location.href='CartPage.php'</script>";
