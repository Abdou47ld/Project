<?php
require 'Controllers/Produit.php';
session_start();

$connected = @$_SESSION["connected"] ; 

  $categorie = @$_GET["categorie"];
  $produit = new Produit();
if ($categorie) {
    $produits = $produit->getProduitsByCat($categorie);
} else {
    $produits = $produit->getProduits();
}


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
            background-color: #ffffff;
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
    padding-left:5%;
    display: flex;
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
 .rowps5{
    background-color:#ffffff;
    padding:5%;
    display: flex;
    flex-direction:row;
    justify-content:center;
    align-items:center;

 }
 .rowps5 .right video{
    width: 500px;
 }
 .rowps5 .btn{
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
        <li><a href="./">Home</a></li>
            <li><a href="./produits.php">Produits</a></li>
            <li><a href="./mescommandes.php">Mes Commandes</a></li>
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
    <div class="rowps5">
        <div class="left">
        <h1>PlayStation®5</h1>
      <h3>DualSense wireless controller</h3>
      <p>Discover a deeper, highly immersive gaming experience1 with the innovative new PS5™ controller, featuring haptic feedback and dynamic trigger effects2. The DualSense wireless controller also includes a built-in microphone and create button, all integrated into an iconic, comfortable design.</p>
      <h4>$69.99</h4>
      <a href="./produitpage.php?id=7" class="btn">Buy now</a>
        </div>
        <div class="right">
        <video style="-webkit-filter:brightness(108.5%)"  autoplay loop muted>
        <source src="https://gmedia.playstation.com/is/content/SIEPDC/global_pdc/en/hardware/accessories/ds5/product-photography/video-renders/dualsense-thumbnail-ps5-01-en-04aug20.mp4">
      </video>
        </div>
    </div>
     <br>
     <div class="title">
        <h1>PRODUITS <?php echo $categorie ?> </h1>
     </div>
    <div class="container">
    <?php
      foreach($produits as $produit){
        echo '<div class="product">';
        echo '<td><img width="150"  src="'.$produit["image_produit"].'"/></td>';
        echo '<h3 class="cat">' . $produit['categorie_produit'] . '</h3>';
        echo '<h3>' . $produit['nom_produit'] . '</h3>';
        echo '<p>Price: $' . $produit['prix_produit'] . '</p>';
        echo '<a href="produitpage.php?id=' . $produit['id'] . '">Voir Produit</a>';
        echo '</div>';

      }
    ?>
    </div>
    
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
        <a href="./mescommandes.php">Mescommandes</a><br>
    </div>
    <div class="col">
        <h2>CATEGORIES</h2><br>
        <a href="./produits.php?categorie=Claviers">Claviers</a><br>
        <a href="./produits.php?categorie=Souris">Souris</a><br>
        <a href="./produits.php?categorie=Webcams">Webcams</a><br>
        <a href="./produits.php?categorie=DisqueDue">DisqueDur</a><br>
    </div>
    <div class="col">
        <h2>NOUS CONTACTER</h2><br>
        <h3><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:">0758462215</a></h3><br>
        <h3><i class="fa fa-whatsapp" aria-hidden="true"></i><a href="tel:">0758462215</a></h3><br>
        <h3><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:yassin@tonnygaming.com">ayoub@tonnygaming.com</a></h3><br>
        
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