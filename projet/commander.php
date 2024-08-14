<?php
require 'Controllers/Commande.php';
require 'Controllers/Produit.php';
require 'Models/CommandeModel.php';

session_start();
$connected = @$_SESSION["connected"] ; 
if(!$connected){
	header("Location: login.php");
  }
  $id = @$_POST["id_produit"];
  $p = new Produit();
  $produit = $p->getProduitByID($id);
  $conn=null;

error_reporting(E_ALL ^ E_NOTICE);  
 
if(isset($_POST["submit"])){

    $nom = $_POST["nom"];
    $adress = $_POST["adress"];
    $codepostal = $_POST["codepostal"];
    $tel = $_POST["tel"];
    $quantite = intval($_POST["quant"]);   
    $prix_total = intval($_POST["prixtotal"]);     
    $id_prod =  $_POST["produit_id"];                                                  
    $liv = 1;
    $c = new CommandeModel($nom,$adress,$codepostal,$tel,$quantite,$prix_total,$_SESSION["client_id"],$id_prod,$liv);
    $commande = new Commande();
    $commande->ajouterCommande($c);
    echo "<script>window.location.href='mescommandes.php'</script>";

    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Commander</title>
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
        <h2>Commander</h2>
        <form enctype="multipart/form-data" action=""  method="post">
        <label for="nom">Nom Complet :</label><br>
              <input required name="nom" type="text"><br>
              <label for="adress">Adress :</label><br>
              <input required name="adress" type="text"><br>
              <label for="adress">Code Postal :</label><br>
              <input required name="codepostal" type="text"><br>
              <label for="adress">Téléphone :</label><br>
              <input required name="tel" type="text"><br>
              <label for="adress">Quantité :</label><br>
              <input  value="<?php echo $_POST["quantity"]; ?>"  name="quant" type="number"><br>
              <label for="prix">Prix Total ($) :</label><br>
              <?php
                $quantitee = intval($_POST["quantity"]);
                $prix = intval($produit["prix_produit"]);
                $prix_total = $quantitee * $prix;
              ?>
              <input  value="<?php echo $prix_total ?>" name="prixtotal" type="text"><br>
              <input type="hidden" name="produit_id" value="<?php echo $produit["id"]; ?>">
            <input type="submit" name="submit" value="Commander">
        </form>
    </div>
</body>
</html>
