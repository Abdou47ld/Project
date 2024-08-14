<?php
error_reporting(E_ALL ^ E_NOTICE);  
require 'Controllers/Database.php';
require 'Controllers/Commande.php';
require 'Models/CommandeModel.php';
session_start();

$connected = @$_SESSION["connected"] ; 
if(!$connected){
	header("Location: login.php");
  }
$db = new Database();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :id");
    $stmt->bindParam(':id', $_SESSION["client_id"]);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST["buycard"])){
  $address = $_POST["address"];
  $tel = $_POST["tel"];
  $cardholderName = $_POST["cardholderName"];
  $cardNumber = $_POST["cardNumber"];
  $expirationDate = $_POST["expirationDate"];
  $cvv = $_POST["cvv"];
  // Insert user into database
  $stmt = $conn->prepare("INSERT INTO `cards` (cardholderName, cardNumber, expirationDate, cvv) VALUES (:cardholderName, :cardNumber, :expirationDate, :cvv)");
  $stmt->bindParam(':cardholderName', $cardholderName);
  $stmt->bindParam(':cardNumber', $cardNumber);
  $stmt->bindParam(':expirationDate', $expirationDate);
  $stmt->bindParam(':cvv', $cvv);

  if ($stmt->execute()) {
      // Registration successful
      foreach ($rows as $row){
        $liv = 1;
        $c = new CommandeModel($cardholderName,$address,24555,$tel,$row["quantity"],$row["prix_total"],$_SESSION["client_id"],$row["produit_id"],$liv);
        $commande = new Commande();
        $commande->ajouterCommande($c);
        unset($c);
      }
      $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :id");
      $stmt->bindParam(':id', $_SESSION["client_id"]);
       $stmt->execute();
      echo "<script>alert('Commande bien Enregistré . Durée de la livraison entre 2 et 3 jours');</script>";
      echo "<script>window.location.href='mescommandes.php'</script>";
      
  } else {
      // Error alert
      echo "<script>alert('Registration failed');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/66e2912732.js" crossorigin="anonymous"></script>

    <title>Cart</title>
    <style>
    .cart-container {
        padding:5%;
        width: 100%;
  display: flex;
  flex-direction:column;
  flex-wrap: wrap;
  justify-content: space-between;
}

.cart-item {
display: flex;
justify-content:space-between;
align-items:center;
  width: 90%;
  margin-bottom: 20px;
  padding: 20px;
  border: 1px solid #ddd;
}

.product-image {
  width: 150px;
  height: auto;
}

.product-details {

  padding: 10px;
}

.product-name {
  margin: 0;
  font-size: 18px;
}

.product-price, .product-quantity, .product-total {
  margin: 5px 0;
}

.remove-link {
  display: inline-block;
  padding: 8px 16px;
  background-color: #ff0000;
  color: #fff;
  text-decoration: none;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.remove-link:hover {
  background-color: #cc0000;
}

        .swiper {
  width: '100%';
  height: 60vh;
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .banner-home{
             width:100%;
             height:60vh;
             background-image:url("./img/razer.jpg");
             background-size:cover;
             background-position:center;
        }
        .banner1{
            width:100%;
             height:100%;
             background-image:url("./img/logitech.jpg");
             background-size:cover;
        }
        .banner2{
            width:100%;
             height:100%;
             background-image:url("./img/razer.jpg");
             background-size:cover;
             background-position:center;
        }
        .banner3{
            width:100%;
             height:100%;
             background-image:url("./img/wallpaper.webp");
             background-size:cover;
             background-position:bottom;
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
 .row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 90px 0;
  color: #1f1f1f;
}

.col-1 {
  flex-basis: 40%;
  position: relative;
  margin-left: 50px;
}

.col-1 h1 {
  font-size: 48px;
}

.col-1 h3 {
  font-size: 39px;
  font-weight: 300;
  margin: 20px 0 10px;
}

.col-1 p {
  font-size: 16px;
}

.col-1 h4 {
  margin: 25px 0;
}

.col-1 .hero-btn {
  background: #d53b00;
  color: #fff;
  border: none;
  padding: 0 1.5rem;
  cursor: pointer;
  font-size: 16px;
  text-align: center;
  line-height: 1.25em;
  height: 2.5rem;
  transition: background 0.5s;
  font-weight: 500;
}

.col-1 .hero-btn:hover {
  background: #c63700;
}

.col-2 {
  position: relative;
  display: flex;
  flex-basis: 40%;
  align-items: center;
}

.col-2 video {
  max-width: 500px;
}

.color-box {
  position: absolute;
  right: 0;
  top: 0;
  background: linear-gradient(#0072ce, #1d2b38);
  border-radius: 40px 0 0 30px;
  height: 100%;
  width: 80%;
  z-index: -1;
}
    .div-right{
      display: flex;
      width: 100%;
      justify-content:space-around;

    }
    .div-right h3{
      font-size:20px;

     font-weight:400;
    }
    .launch{height: 50px}.close{font-size: 21px;cursor: pointer}.modal-body{height: 570px}.nav-tabs{border:none !important}.nav-tabs .nav-link.active{color: #495057;background-color: #fff;border-color: #ffffff #ffffff #fff;border-top: 3px solid blue !important}.nav-tabs .nav-link{margin-bottom: -1px;border: 1px solid transparent;border-top-left-radius: 0rem;border-top-right-radius: 0rem;border-top: 3px solid #eee;font-size: 20px}.nav-tabs .nav-link:hover{border-color: #e9ecef #ffffff #ffffff}.nav-tabs{display: table !important;width: 100%}.nav-item{display: table-cell}.form-control{border-bottom: 1px solid #eee !important;border:none;font-weight: 600}.form-control:focus{color: #495057;background-color: #fff;border-color: #8bbafe;outline: 0;box-shadow: none}.inputbox{position: relative;margin-bottom: 20px;width: 100%}.inputbox span{position: absolute;top:7px;left: 11px;transition: 0.5s}.inputbox i{position: absolute;top: 13px;right: 8px;transition: 0.5s;color: #3F51B5}input::-webkit-outer-spin-button, input::-webkit-inner-spin-button{-webkit-appearance: none;margin: 0}.inputbox input:focus~span{transform: translateX(-0px) translateY(-15px);font-size: 12px}.inputbox input:valid~span{transform: translateX(-0px) translateY(-15px);font-size: 12px}.pay button{height: 47px;border-radius: 37px}
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
        </li>
        </ul>
        <div class="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </nav>
</div>

<div class="cart-container">
  <?php
  $total = 0;
  foreach ($rows as $row) {
    $total += $row['prix_total'];
    echo '<div class="cart-item">';
    echo '<img class="product-image" src="' . $row["image_produit"] . '"/>';
    echo '<div class="product-details">';
    echo '<h3 class="product-name">Produit : ' . $row['nom_produit'] . '</h3>';
    echo '<p class="product-price">Prix : ' . $row['prix_produit'] . '$</p>';
    echo '<p class="product-quantity">Quantity : ' . $row['quantity'] . '</p>';
    echo '<p class="product-total">Prix Total : ' . $row['prix_total'] . '$</p>';
    echo '</div>';
    echo '<a class="remove-link butt" href="supprimercart.php?id=' . $row['cart_id'] . '">Supprimer</a>';
    echo '</div>';
  }
  ?>
  
</div>
 <div class="div-right">
   <?php
     if($rows){
      echo '<div class="left">';
echo '    <h3>Achat</h3>';
echo '    <h3>Livraison</h3>';
echo '    <h3 style="font-weight:600">Total</h3>';
echo '</div>';

echo '<div class="right">';
echo '    <h3>' . $total . '$</h3>';
echo '    <h3>2$</h3>';
echo '    <h3 style="font-weight:600">' . ($total + 2) . '$</h3>';
echo '    <button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop">';
echo '        <i class="fa fa-rocket"></i> Pay Now';
echo '    </button>';
     }else{
        echo "Panier est vide !";
     }
   ?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-right">
          <i class="fa fa-close close" data-dismiss="modal"></i>
        </div>
        <div class="tabs mt-3">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="visa-tab" data-toggle="tab" href="#visa" role="tab" aria-controls="visa" aria-selected="true">
                <img src="https://i.imgur.com/sB4jftM.png" width="80">
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="false">
                <img src="https://i.imgur.com/yK7EDD1.png" width="80">
              </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="visa" role="tabpanel" aria-labelledby="visa-tab">
  
          <form id="visa-form" action="" method="post" onsubmit="return validateForm()">
  <div class="mt-4 mx-4">
    <div class="text-center">
      <h5>Credit card</h5>
    </div>
    <div class="form mt-3">
    <div class="inputbox">
        <input type="text" name="address" id="address" class="form-control" required>
        <span>Address</span>
      </div>
      <div class="inputbox">
        <input type="text" name="tel" id="tel" class="form-control" required>
        <span>Telephone</span>
      </div>
      <div class="inputbox">
        <input type="text" name="cardholderName" id="cardholderName" class="form-control" required>
        <span>Cardholder Name</span>
      </div>
      <div class="inputbox">
        <input type="text" name="cardNumber" id="cardNumber" class="form-control" required>
        <span>Card Number</span>
        <i class="fa fa-eye"></i>
      </div>
      <div class="d-flex flex-row">
        <div class="inputbox">
          <input type="text" name="expirationDate" id="expirationDate" class="form-control" required>
          <span>Expiration Date (MM/YY)</span>
        </div>
        <div class="inputbox">
          <input type="text" name="cvv" id="cvv" class="form-control" required>
          <span>CVV</span>
        </div>
      </div>
      <div class="px-5 pay">
        <button type="submit" name="buycard" class="btn btn-success btn-block">Add card</button>
        <div id="alertMessages"></div> <!-- Alert messages container -->

      </div>
    </div>
  </div>
</form>

</div>
<!-- Ajoutez ce script dans votre <head> ou avant </body> -->
<script src="https://www.paypal.com/sdk/js?client-id=AfaNgCFgsUUCimtCYfAAPxhERia6vAINFevwp4OioUHHKSMPvdJ2NPpPTT-PriU4c4oL1lowhYMKjW5H"></script>

<div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
  <div class="px-5 mt-5">
    <div class="inputbox">
     
    </div>
    <div class="pay px-5">
      
      <div id="paypal-button-container"></div>
    </div>
  </div>
</div>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01' 
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
</script>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

   </div>
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
function validateForm() {
    var cardholderName = document.getElementById("cardholderName").value;
    var cardNumber = document.getElementById("cardNumber").value;
    var expirationDate = document.getElementById("expirationDate").value;
    var cvv = document.getElementById("cvv").value;

    var cardNumberPattern = /^\d{16}$/;
    var expirationDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
    var cvvPattern = /^\d{3}$/;
    var cardholderNamePattern = /^[a-zA-Z]+(?: [a-zA-Z]+)*$/;

    var alertDiv = document.getElementById("alertMessages");
    alertDiv.innerHTML = ""; // Clear previous alert messages

    if (!cardNumber.match(cardNumberPattern)) {
      alertDiv.innerHTML += "<div class='alert alert-danger' role='alert'>Card number must be 16 digits</div>";
      return false;
    }

    if (!expirationDate.match(expirationDatePattern)) {
      alertDiv.innerHTML += "<div class='alert alert-danger' role='alert'>Expiration date must be in MM/YY format</div>";
      return false;
    }

    if (!cvv.match(cvvPattern)) {
      alertDiv.innerHTML += "<div class='alert alert-danger' role='alert'>CVV must be 3 digits</div>";
      return false;
    }

    if (!cardholderName.match(cardholderNamePattern)) {
      alertDiv.innerHTML += "<div class='alert alert-danger' role='alert'>Cardholder name should not contain numbers</div>";
      return false;
    }

    return true;
  }

        </script>
</body>

</html>