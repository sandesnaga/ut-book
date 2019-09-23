<!DOCTYPE html>
<?php
    session_start();
    include("includes/connection.php");   
    include("functions/function.php");
?>
<?php
if(!isset($_SESSION['page_id'])){
    header("location: home.php");
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
                            $page = $_SESSION['page_id']; 
                            $get_page = "SELECT * FROM profile WHERE page_id = '$page'";
                            $run_page = mysqli_query($con,$get_page);
                            $row = mysqli_fetch_array($run_page);
                            $page_id= $row['page_id'];
                            $page_name= $row['page_name'];
                            $page_dis= $row['page_description'];
                            $page_cat = $row['page_category'];
  echo "<script>alert('$page_id'); </script>";
                            echo "
                            <centre>
                                <div id='user_mention'>
                                <p><centre><h2>$page_name</h2></centre>                                
                               </div>

                            ";
                        ?>

                    </div>
                </div>                 
                <div id = "content_timeline">
                  <form action= "homepage.php?id =<?php echo $page_id; ?>" method= "post" id = "b">
                        <textarea cols = "83" rows = "4" name = "content" placeholder = "whats on your mind?"></textarea><br>
                        <input type = "submit" name = "sub" value ="post" style ="width: 100px;">
                    </form>
                    <?php insert_Post(); ?>
                    <center><h2>News Feeds</h2></center>
                    <?php get_page_posts(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
<?php } ?>