<?php
    session_start();
    include("includes/connection.php");

    if(isset($_POST['login_user']))
    {
        //taking the username and password form the fourm
       $userEmail = mysqli_real_escape_string($con,$_POST['email']);
         $userPassword = mysqli_real_escape_string($con,$_POST['password']);

        if (empty($userEmail)) {
            array_push($errors, "Username is required");
        }
        if (empty($userPassword)) {
            array_push($errors, "Password is required");
        }
 
       
        $select_user = "SELECT * FROM profile WHERE user_email = '$userEmail' AND  user_password = '$userPassword'";

        $query = mysqli_query($con, $select_user);
        $check_query = mysqli_num_rows($query);
        if($check_query==1)
        {
            $_SESSION['user_email'] = $userEmail;                             
            echo "<script> window.open('home.php','_self') </script>";
        }
        else {
            echo "<script>alert('Incorrect credentials, try again'); </script>";
            echo "<script> window.open('index.php','_self') </script>";

        }
        
    }
    
?>