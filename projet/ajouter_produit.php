<?php
require 'Controllers/Produit.php';
require 'Models/ProduitModel.php';
session_start();
error_reporting(E_ALL ^ E_NOTICE);  

$connected = @$_SESSION["admin_connected"] ; // assurer que le compte est admin pour ajouter les produits
if(!$connected){
	header("Location: index.php");
  }
if(isset($_POST["submit"])){
    if(!empty($_POST["nom_produit"]) && !empty($_POST["description_produit"]) && !empty($_POST["prix_produit"])&& !empty($_POST["categorie_produit"])){
       //upload image dans fichier /uploads
        $allowedTypes_carte = ['jpeg', 'png','jpg'];
     $maxSize = 10 * 1024 * 1024;
     $file_carte =  $_FILES["image_produit"]["name"];
     $ext_carte = pathinfo($file_carte,PATHINFO_EXTENSION);
     if(in_array($ext_carte, $allowedTypes_carte) && $_FILES['image_produit']['size'] <= $maxSize) {
 
         $carte_name = ".".pathinfo($_FILES['image_produit']['name'], PATHINFO_EXTENSION);
         $carte_path = "uploads/". $_POST["nom_produit"]. "".$carte_name;
         $path_carte = "uploads/".$carte_path;
 
         move_uploaded_file($_FILES['image_produit']['tmp_name'], $carte_path);
         $nom = $_POST["nom_produit"];
         $desc = $_POST["description_produit"];
         $prix = $_POST["prix_produit"];
         $categ = $_POST["categorie_produit"];
         $p = new ProduitModel($nom, $desc, $carte_path, $prix, $categ);
         $produit = new Produit();
         $produit->ajouterProduit($p);     
         echo "<script>window.location = './mesproduits.php'</script>";
   
     } else {
       echo "<p class='alert alert-warning' role='alert'>Le fichier carte doit être une image de type JPEG ou PNG et ne doit pas dépasser 3Mo.</p>";
     } 
     
    }else{
      echo "empty";
    }
 
 }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        form {
            display: flex;
            flex-direction: column;
        }
        
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        input, textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        input[type="submit"] {
            background-color: #45D62E;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body><br><br>
    <div class="container">
        <h2>Ajouter Produit</h2>
        <form action="" enctype="multipart/form-data" method="post">
        <label for="nom">Nom Prdouit :</label><br>
              <input required name="nom_produit" type="text"><br>
              <label for="adress">Description :</label><br>
              <input required name="description_produit" type="text"><br>
              <label for="image">Image :</label><br>
              <input required name="image_produit" id="image_produit" type="file"><br>
              <label for="prix">Prix ($) :</label><br>
              <input required name="prix_produit" type="text"><br>
              <label for="cat">Catégorie :</label><br>
              <input required name="categorie_produit" type="text"><br>
            <input type="submit" name="submit" value="Ajouter produit">
        </form>
    </div>
</body>
</html>
