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
                                <p><a href= 'view_page.php?u_id=$user_id'>View all your pages</a></p>

                                <p><a href ='logout.php?u_id=$user_id'>Logout</a></p>
                               </div>

                            ";
                        ?>

                    </div>
                </div>                 
                <div id = "content_timeline">
                    <form action= "home.php?id =<?php echo $user_id; ?>" method= "post" id = "b">
                        <textarea cols = "83" rows = "4" name = "content" placeholder = "whats on your mind?"></textarea><br>
                        <input type = "submit" name = "sub" value ="post" style ="width: 100px;">
                    </form>
                    <?php insert_Post(); ?>
                    <center><h2>News Feeds</h2></center>
                    <?php get_posts(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
<?php } ?>