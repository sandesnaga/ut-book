<?php
include("includes/connection.php");


    if(isset($_POST['sign_up']))
{

        $userName = mysqli_real_escape_string($con,$_POST['username']);
        $userLastname = mysqli_real_escape_string($con,$_POST['lastname']);
        $userEmail = mysqli_real_escape_string($con,$_POST['useremail']);
        $userPassword = mysqli_real_escape_string($con,$_POST['userpassword']);
        $userPhone = mysqli_real_escape_string($con,$_POST['phonenumber']);
        $userStreet = mysqli_real_escape_string($con,$_POST['street']);
        $userCity = mysqli_real_escape_string($con,$_POST['city']);
        $userState = mysqli_real_escape_string($con,$_POST['state']);
        $userCountry = mysqli_real_escape_string($con,$_POST['country']);
        $userZip = mysqli_real_escape_string($con,$_POST['zip']);
        $userBirthday = mysqli_real_escape_string($con,$_POST['user_birthday']);
        $userGender = mysqli_real_escape_string($con,$_POST['user_gender']);
        $status = "verified";
        $post = "no";
        if(strlen($userPassword)<6){
            echo "<script>alert('Password should be atleast minimum 6 character!')</script>";
            exit();
        }
        $check_email = "select * from profile where user_email='$userEmail'";
        $run_email = mysqli_query($con,$check_email);

         $select_user = "SELECT * FROM profile WHERE user_email = '$userEmail'";

        $query = mysqli_query($con, $select_user);
        $check_query = mysqli_num_rows($query);
        if($check_query==1)
        {
           echo "<script>alert('Email already exist try another')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            exit();
        }

       
        $insert = "insert into profile(
        user_fname,user_lname,user_email,user_phone,user_password,user_street,user_city,user_state,user_country,user_zip,user_dob,user_posts,user_status,user_gender,registration_date,profile_picture) values (
        '$userName','$userLastname','$userEmail','$userPhone','$userPassword','$userStreet','$userCity','$userState','$userCountry','$userZip','$userBirthday','$post','$status','$userGender',NOW(),'default.jpg')" ;

        $query= mysqli_query($con,$insert);

        if($query){
            echo "<script>alert('Congratulation $userName, your account has been created sucessfully.')</script>";
             echo "<script>window.open('index.php','_self')</script>";
        }
        else{
            echo "<script>alert('Registration fail, try again')</script>";
        }

    }

?>