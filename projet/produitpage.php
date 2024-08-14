<?php
require 'Controllers/Produit.php';
session_start();
$connected = @$_SESSION["connected"] ; 

$id = @$_GET["id"];
$p1 = new Produit();
$produit = $p1->getProduitByID($id);

if(! $produit){
   header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/66e2912732.js" crossorigin="anonymous"></script>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    
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
  .product-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 500px;
    width: 100%;
  }
  .product-image {
    max-width: 100%;
    height: auto;
  }
  .product-title {
    font-size: 24px;
    margin: 10px 0;
  }
  .product-description {
    font-size: 16px;
    color: #666;
    margin: 10px 0;
  }
  .product-price {
    font-size: 20px;
    color: #45D62E;
  }
  .quantity-input {
    width: 50px;
    padding: 5px;
    text-align: center;
  }
  .order-button {
    display: block;
    width: 100%;
    background-color: #45D62E;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px;
    font-size: 18px;
    cursor: pointer;
  }
  a{
    text-decoration:none;
 }
 .bef-footer{
    margin-top:20px;
 }
 .bef-footer-row{
    padding: 30px;
    display: flex;
    align-items:center;
    flex-wrap:wrap;
    justify-content:center;
    grid-gap:20px;
    background-color:#111111;
    color:white;
 }
 .bef-footer-row .col{
    border-bottom:5px solid #45D62E;
    padding: 10px;
    display: flex;
    flex-direction:column;
    align-items:center;
    width: 200px;
    background-color:#080808;
    text-align:center;
 }
 .bef-footer-row .col .title{
    font-weight:600;
    font-size:16px;
 }
 .bef-footer-row .col i{
    font-size:40px;
 }
 footer{
    padding:20px;
    display: flex;
    flex-wrap:wrap;
    justify-content:center;
    grid-gap:20px;
    background-color:#080808;
    color:white;
 }
 footer h2{
   font-size:17px;
 }
 footer .col a{
    padding-bottom:16px;
 }
 a{
    text-decoration:none !important;
 }
 footer .col{
    padding:10px;
 }
 footer .col h3{
    font-size:20px;
    font-weight:700;
 }
 footer .col a{
    font-size:18px;
    color:#45D62E !important;

 }
 footer .col i{
    margin-right: 5px;
 }
 footer .col .row{
    display: flex !important;
    flex-direction:row !important;
 } 
 footer .col .row a{

    width: 50px;
 }
 .center-body{
    padding:5%;
    display: flex;
    justify-content:center;
    flex-direction:column !important;
    align-items:center

 }
</style>
<title>Product Page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <img src="./img/logo.jpg" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="./">Home</a></li>
            <li><a href="./produits.php">Produits</a></li>
            <li><a href="./mescommandes.php">Mes commandes</a></li>
            <?php
                if($connected){
                    echo '<li><a style="color:#45D62E;font-weight:600;background-color:black;padding:5px 20px;border-radius:10px" id="logout" href="logout.php" id="submit" name="submit">Déconnexion </a>';
                    echo '<li><a style="color:#45D62E;font-weight:600;background-color:black;padding:5px 20px;border-radius:10px" id="logout" href="CartPage.php" id="submit" name="submit"> 🛒 </a>';

                }else{
                    echo '<li><a style="color:#45D62E;font-weight:600;background-color:black;padding:5px 20px;border-radius:10px" id="logout" href="login.php" id="submit" name="submit">Connexion </a>';
                }
            ?>
        </ul>
        <div class="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </nav>
   <div class="center-body">
   <div class="product-container">
    <img class="product-image" src="<?php echo $produit["image_produit"]; ?>" alt="Product Image">
    <h2 class="product-title"><?php echo $produit["nom_produit"]; ?></h2>
    <p class="product-price">Catégorie :<?php echo $produit["categorie_produit"]; ?></p>
    <p class="product-description"><?php echo $produit["description_produit"]; ?></p>
    <p class="product-price"><?php echo $produit["prix_produit"]; ?>$</p>
   <!-- <form action="commander.php" method="post">
        <input type="hidden" name="id_produit" value="<?php echo $produit["id"]; ?>">
    <label for="quantity">Quantité:</label>
    <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1"><br><br>
    <button class="order-button">Commander</button>
    </form> --> 
    <form action="addcart.php" method="POST">
        <input type="hidden" name="id_produit" value="<?php echo $produit["id"]; ?>">
        <input type="hidden" name="nom_produit" value="<?php echo $produit["nom_produit"]; ?>">
        <input type="hidden" name="image_produit" value="<?php echo $produit["image_produit"]; ?>">
        <input type="hidden" name="id_produit" value="<?php echo $produit["id"]; ?>">
        <input type="hidden" name="prix_produit" value="<?php echo $produit["prix_produit"]; ?>">

    <label for="quantity">Quantité:</label>
    <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1"><br><br>
    <button class="order-button">Add To Cart</button>
    </form>
  </div>
   </div>
</body>
<div class="bef-footer">
     <div class="bef-footer-row">
        <div class="col">
        <i class="fa fa-truck" aria-hidden="true"></i><br>
         <div class="title">Livraison</div><br>
         <div class="desc">Livraison  48h partout au Canada</div>
        </div>
        <div class="col">
        <i class="fa fa-money" aria-hidden="true"></i><br>
         <div class="title">Méthodes de paiement</div><br>
         <div class="desc">Une multitude de moyens de paiements</div>
        </div>
        <div class="col">
        <i class="fa fa-clock-o" aria-hidden="true"></i><br>
         <div class="title">Garantie Constructeur
</div>
         <div class="desc">1 an de garantie sur tous nos produits
</div>
        </div>
        <div class="col">
        <i class="fa fa-smile-o" aria-hidden="true"></i><br>
         <div class="title">Help Desk</div>
         <div class="desc">Nos agents sont là pour vous aider.
</div>
        </div>
     </div>
</div>
<footer>
    <div class="col">
        <h2>LIEN UTILES</h2><br>
        <a href="./">Home</a><br>
        <a href="./produits.php">Produits</a><br>
        <a href="./mescommandes.php">Mes commandes</a><br>
    </div>
    <div class="col">
        <h2>CATEGORIES</h2><br>
        <a href="/">Claviers</a><br>
        <a href="/">Souris</a><br>
        <a href="/">Webcams</a><br>
        <a href="/">DisqueDur</a><br>
    </div>
    <div class="col">
        <h2>NOUS CONTACTER</h2><br>
        <h3><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:">0758462215</a></h3><br>
        <h3><i class="fa fa-whatsapp" aria-hidden="true"></i><a href="tel:">0758462215</a></h3><br>
        <h3><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:yassin@tonnygaming.com">yassin@tonnygaming.com</a></h3><br>
        
    </div>
    <div class="col">
    <h2>SOCIALS MEDIA </h2><br>
        <div style="display:flex" class="row">
            <a href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>   
        </div>
        <img width="100" src="./img/logo.jpg" alt="">
    </div>
</footer>
<script>
        document.addEventListener("DOMContentLoaded", function () {
    const burger = document.querySelector(".burger");
    const navLinks = document.querySelector(".nav-links");
    
    burger.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
});
        </script>
</html>
