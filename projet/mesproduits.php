<?php
require 'Controllers/Produit.php';
session_start();

$connected = @$_SESSION["admin_connected"] ; 
if(!$connected){
	header("Location: login.php");
  }
  $produit = new Produit();
  $produits = $produit->getProduits();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/66e2912732.js" crossorigin="anonymous"></script>

    <title>Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .banner-home{
             width:100%;
             height:50vh;
             background-image:url("./img/razer.jpg");
             background-size:cover;
             background-position:center;
        }
        .container {
            display: flex;
            justify-content:center;
            flex-wrap:wrap;
            grid-gap:20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .product {
            background-color:#F9F9F9;
            width: 180px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .product h3 {
            font-size:16px;
            font-weight:700;
            margin: 0;
        }
        
        .product p {
            margin: 5px 0;
        }
        
        .product a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #45D62E;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .cat{
            color: #45D62E;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
        .logo img {
    width: 50px;
    height: 50px;
}

.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin-right: 20px;
}

.nav-links a {
    text-decoration: none;
    color: #fff;
}

.burger {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.line {
    height: 3px;
    width: 25px;
    background-color: #fff;
    margin: 3px 0;
}
.navbar {
    background-color: #333;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}
@media (max-width: 768px) {
    .burger {
        display: flex;
    }
    
    .nav-links {
        display: none;
        flex-direction: column;
        background-color: #333;
        width: 100%;
        position: absolute;
        top: 65px;
        left: 0;
        text-align: center;
    }
    
    .nav-links.active {
        display: flex;
    }
    
    .nav-links li {
        margin: 10px 0;
    }
}
 .title{
    padding:2% 5%;
    display: flex;
    justify-content:space-between;
    align-items:center;
 }
 .title h1{
    font-size:20px;
    font-weight:700;
 }
 .title h4{
    margin-left:5px;
    font-size:16px;
    color:#45D62E;
 }
 a{
    text-decoration:none;
 }
 .row-buttons{
    display: flex;
    justify-content: center;
    align-items: center;
    grid-gap:10px;
    margin-top: 10px;
 }
 .button{
    display: inline-block;
            padding: 5px 10px;
            background-color: #45D62E;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
 }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="./img/logo.jpg" alt="Logo">
        </div>
        <ul class="nav-links">
        <li><a href="./mesproduits.php">Mes produits</a></li>   
                <li><a href="./mesorders.php">Mes orders</a></li>
            <li><a style="color:#45D62E;font-weight:600" id='logout' href="logout.php" id="submit" name="submit">Déconnexion </a>
</li>
        </ul>
        <div class="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </nav>
     <br>
     <div class="title">
        <h1>MES PRODUITS</h1><a class="button" href="./ajouter_produit.php">Ajouter Produit</a>
     </div>
    <div class="container">
    <?php
      foreach($produits as $produit){
        echo '<div class="product">';
        echo '<td><img width="150" src="'.$produit["image_produit"].'"/></td>';
        echo '<h3 class="cat">' . $produit['categorie_produit'] . '</h3>';
        echo '<h3>' . $produit['nom_produit'] . '</h3>';
        echo '<p>Price: $' . $produit['prix_produit'] . '</p>';
        echo '<div class="row-buttons"><a href="modifier_produit.php?id=' . $produit['id'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>        </a>';
        echo '<a href="supprimer_produit.php?id=' . $produit['id'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>';
        echo '</div>';

      }
    ?>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const burger = document.querySelector(".burger");
    const navLinks = document.querySelector(".nav-links");
    
    burger.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
});
        </script>
</body>

</html>