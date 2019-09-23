<?php 
require 'includes/connection.php'

if(isset($_SESSION['user_email'])){
    $userEmail = $_SESSION['user_email'];
}
else {
    header("Location:user_login.php";)
}

?>

<html>
    <head>
        <title>welcome to ut book</title>
    </head>
    <body>