<?php

require 'Database.php';


class User {
    private $db;

    public function __construct() {
        $dbClass = new Database();
        $this->db = $dbClass->getConnection();
    }

    public function login($email, $password) {
        if ($email == "ayoub@gmail.com" && $password == "admin") {
            $_SESSION["admin_connected"] = true;
            echo "<script>window.location = './mesproduits.php'</script>";
        }else{
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                // Successful login
                $_SESSION["connected"] = true;
                $_SESSION["client_id"] = $user["user_id"];
                echo "<script>window.location = './index.php'</script>";
            } else {
                // Error alert
                echo "<script>alert('Invalid email or password');</script>";
    
            }
        }
       
    }

    public function register($user) {

        // Insert user into database
        $stmt = $this->db->prepare("INSERT INTO `users` (firstname, lastname, email, password, telephone) VALUES (:firstname, :lastname, :email, :password, :telephone)");
        $stmt->bindParam(':firstname', $user->getFirstname());
        $stmt->bindParam(':lastname', $user->getLastname());
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':password', $user->getPassword());
        $stmt->bindParam(':telephone', $user->getTelephone());

        if ($stmt->execute()) {
            // Registration successful
            echo "<script>alert('Registration successful');</script>";
            header("Location:login.php");


        } else {
            // Error alert
            echo "<script>alert('Registration failed');</script>";
        }
    }
}

