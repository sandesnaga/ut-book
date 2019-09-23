<!DOCTYPE html>
<?php
    session_start();
    include("includes/connection.php");   
    include("functions/function.php");
?>
<?php
if(!isset($_SESSION['user_email'])){
    header("location: index.php");
}
else{?>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel ="stylesheet" type="text/css" href = "styles/home_style.css">
    </head>
    <body>

        <div class = "container">
            <div id= "head_wrap">
                <div id= "header">
                    <ul  id = "menu">
                    <nav>
            <a href="#">
            <i class="fas fa-home"></i>
            </a>

            <a href="#">
            <i class="far fa-envelope"></i>
            </a>

            <a href="#">
            <i class="fas fa-bell"></i>
            </a>
            <a href="#">
            <i class="fas fa-users"></i>
            </a>
                    </ul>
                    <form id = "search_bar" method="post" action="results.php">
                        <input type= "text" name = "search_item" placeholder ="search">
                        <input type= "submit" name = "search" value= "search">

                    </form>
                </div>
            </div>
            <div class= "body_content">
                <div id= "user_timeline">
                    <div id = "user_detail">
                    <?php
                            $user = $_SESSION['user_email']; 
                            $get_user = "SELECT * FROM profile WHERE user_email = '$user'";
                            $run_user = mysqli_query($con,$get_user);
                            $row = mysqli_fetch_array($run_user);
                            $user_id= $row['user_id'];
                            $user_name= $row['user_fname'];
                            $user_lname= $row['user_lname'];
                            $user_image = $row['profile_picture'];

                            echo "
                            <centre>
                                <img src ='users/$user_image' width='200'/>
                                </centre>
                                <div id='user_mention'>
                                <p><centre><h2>$user_name $user_lname</h2></centre>                                
                                <p><a href ='my_post.php?u_id=$user_id'>My Posts</a></p>
                                <p><a href= 'messages.php? Inbox&u_id=$user_id'>Messages</a></p>
                                <p><a href= 'edit_profile.php?u_id=$user_id'>Edit my Account</a></p>
                                <p><a href= 'create_page.php?u_id=$user_id'>create a page</a></p>
                                <p><a href ='logout.php?u_id=$user_id'>Logout</a></p>
                               </div>

                            ";
                        ?>

                    </div>
                </div>                 
                <div id = "content_timeline">
                    <div id="page_details">
                        <form method="POST">
                            <input type="text" name="page_name" placeholder="Page Name" required><br>
                            <input type="text" name="page_desc" placeholder="Page descripton" required><br>
                            <input type="text" name="page_category" placeholder="Page Category" required><br>
                            <input type="submit" name="create_page" value= "Create" required>
                        </form>
                        <?php 
                        if(isset($_POST['create_page']))
                        {
                            $page_name = $_POST['page_name'];
                            $page_desc = $_POST['page_desc'];
                            $page_category = $_POST['page_category'];

                            
                            if(isset($_GET['u_id']))
                            {
                                $user_id = $_GET['u_id'];
                            }
                            else 
                            {
                                echo "<script>alert('Error occured please try again.'); </script>";
                            }
                            // getting the details of the user who is trying to create page using user id

                            $user_detail_query = "Select * from profile where user_id= '$user_id'";

                            $user_query_result = mysqli_query($con, $user_detail_query);

                            $row = mysqli_fetch_array($user_query_result);
                            $user_name = $row['user_fname'];


                            //insert the page info into page database
                            $page_insert_query = "insert into page (page_name, page_description ,page_category, page_admin,profile_id, profile_date)
                                                    values('$page_name', '$page_desc', '$page_category', '$user_name', '$user_id', now())";
                            $page_insert_result = mysqli_query($con, $page_insert_query);
                            
                            if($page_insert_result)
                            {
                                echo "<script>alert('page successfully created'); </script>";
                            }
                            else
                            {
                                echo "<script>alert('Error occured while creating the page. try again.'); </script>";

                            }

                            //echo "<script>alert('values $user_id $page_name, $page_desc, $page_category'); </script>";

                        }


                        ?>  
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php } ?>