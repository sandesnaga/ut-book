<?php
$con = mysqli_connect("localhost","root","root", "s_network") or die("Connection failed.");


    if(isset($_GET['post_id']))
    {
        $post_id = $_GET['post_id'];

        $delete_post_query = "delete from posts where post_id = '$post_id'";

        $run_delete_query = mysqli_query($con, $delete_post_query);

        if($run_delete_query)
        {
            echo "<script>alert('post deleated successfully'); </script>";
            echo "<script>window.open('home.php','_self') </script>";
        }
        else
        {
            echo "<script>alert('Error occured while deleating the post. Please try again.'); </script>";

        }
    }
?>