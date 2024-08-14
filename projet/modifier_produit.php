<?php
require 'Controllers/Produit.php';
session_start();
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
    if(isset($_POST["submit"])) {
        $nom = $_POST["nom_produit"];
        $desc = $_POST["description_produit"];
        $prix = $_POST["prix_produit"];
        $cate = $_POST["categorie_produit"];
        $id = $_GET["id"];
        $produit = new Produit();
        $produit->updateProduit($id, $nom, $desc, $prix, $cate);
        header("Location: mesproduits.php");

    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier Produit</title>
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
<body>
    <br><br>
    <div class="container">
        <h2>Modifier Produit</h2>
        <form action="" enctype="multipart/form-data" method="post">
        <label for="nom">Nom Prdouit :</label><br>
              <input value="<?php echo $article["nom_produit"]; ?>" required name="nom_produit" type="text"><br>
              <label for="adress">Description :</label><br>
              <input value="<?php echo $article["description_produit"]; ?>" required name="description_produit" type="text"><br>
              <label for="prix">Prix ($) :</label><br>
              <input value="<?php echo $article["prix_produit"]; ?>" required name="prix_produit" type="text"><br>
              <label for="cat">Catégorie :</label><br>
              <input value="<?php echo $article["categorie_produit"]; ?>" required name="categorie_produit" type="text"><br>
            <input  type="submit" name="submit" value="Modifier produit">
        </form>
    </div>
</body>
</html>
