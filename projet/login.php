<?php

require 'Controllers/User.php';
require 'Models/UserModel.php';
session_start();
$connected = @$_SESSION["connected"] ; 
$admin_connected = @$_SESSION["admin_connected"] ; 
error_reporting(E_ALL ^ E_NOTICE);  

if($connected){
	header("Location: index.php");
  }
  if($admin_connected){
	header("Location: mesproduits.php");
  }
// login 

if(isset($_POST["logsubmit"])) {
    if ($_POST['logemail'] != "" || $_POST['logpassword'] != "") {
        $email = $_POST['logemail'];
        $password = $_POST['logpassword'];
        $user = new User();
        $user->login($email, $password);
        
       
    }
}


if(isset($_POST["signsubmit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $telephone = $_POST["telephone"];
	$u = new UserModel($firstname, $lastname, $email, $password, $telephone);
    $user = new User();
    $user->register($u);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login/Sign Up</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/2ff52a64bf.js" crossorigin="anonymous"></script>
		<link href="./assets/img/game-controller.png" rel="icon">
    <link href="./assets/img/game-controller.png" rel="apple-touch-icon">
</head>

<body>

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form class="loginf" action="" method="POST">
			<h1>Créer un compte</h1>
			<input type="text" placeholder="First Name"  name="firstname"/>
			<input type="text" placeholder="Last Name"name="lastname"/>
			<input type="email" placeholder="Email" name="email"/>
			<input type="number" placeholder="Telephone" name="telephone"/>
			<input type="password" placeholder="Password" name="password"/>
			
			<a href="#"></a>
			<button type="submit" name="signsubmit">S'inscrire</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="" method="post">
			<h1>Connexion</h1>
			<div class="social-container">
				<a href="https://www.facebook.com/profile.php?id=100027329780404" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-instagram"></i></a>
				<a href="#" class="social"><i class="fab fa-twitter"></i></a>
			</div>
			<input type="email" placeholder="Email" name="logemail" id="logemail"/>
			<input type="password" placeholder="Password" name="logpassword" id="logpassword" />
			<a href="#"></a>
			<button type="submit" name="logsubmit">Connexion</button>
			
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1 class="lighting">Bienvenue Gamer !</h1>
				<p class="lighting" >Pour rester connecté avec nous, veuillez créer votre compte avec vos informations personnelles</p>
				<button class="ghost" id="signIn">Connexion</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1 class="lighting" >Salut,Gamer !</h1>
				<p class="lighting" >Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">S'inscrire</button>
			</div>
		</div>
	</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
	<script src="login.js"></script>
</body>

</html>