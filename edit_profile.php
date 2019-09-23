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
                            $user_password = $row['user_password'];
                            $user_email = $row['user_email'];
                            $user_street = $row['user_street'];
                            $user_city = $row['user_city'];
                            $user_state = $row['user_state'];
                            $user_country = $row['user_country'];
                            $user_dob = $row['user_dob'];
                            $user_dbpost = $row['user_posts'];
                            $user_status = $row['user_status'];
                            $user_phone = $row['user_phone'];
                            $user_zip = $row['user_zip'];
                            $user_lname= $row['user_lname'];
                            $user_regDate = $row['registration_date'];
                            $user_image = $row['profile_picture'];
                            $user_gender = $row['user_gender'];
                            $user_pic = $row['profile_picture'];

                            echo "
                            <centre>
                                <img src ='users/$user_image' width='200'/>
                                </centre>
                                <div id='user_mention'>
                                <p><centre><h2>$user_name $user_lname</h2></centre>                                
                                <p><a href ='my_post.php?u_id=$user_id'>My Posts</a></p>
                                <p><a href= 'messages.php? Inbox&u_id=$user_id'>Messages</a></p>
                                <p><a href= 'edit_profile.php?u_id=$user_id'>Edit my Account</a></p>
                                <p><a href ='logout.php?u_id=$user_id'>Logout</a></p>
                               </div>

                            ";
                        ?>

                    </div>
                </div>                 
                <div id = "content_timeline">
                    <form method= 'post' id='edit' class='editedit' enctype = "multipart/form-data"> 
                    <table>
                        <tr align= "center">
                            <td colspan= "6">
                                <h2>Edit your Profie</h2>
                            </td>                        
                        </tr>
                        <tr>
                            <td align="right">First Name: </td>
                            <td>
                                <input type="text" name = "u_name" required ="required" value= "<?php echo $user_name ; ?>" />
                            </td> 
                        </tr>

                        <tr>
                            <td align="right">Last Name: </td>
                            <td>
                                <input type="text" name = "l_name" required ="required" value= "<?php echo $user_lname ; ?>" />
                            </td> 
                        </tr>

                        <tr>
                            <td align="right">Email: </td>
                            <td>
                                <input type="text" name = "u_email" required ="required" value= "<?php echo $user_email ; ?>" />
                            </td> 
                        </tr>

                        <tr>
                            <td align="right">Password: </td>
                            <td>
                                <input type="password" name = "u_password" id= "password" required ="required" value= "<?php echo $user_password ; ?>" />
                            </td> 
                        </tr>

                        <tr>
                            <td align="right">Phone Number: </td>
                            <td>
                                <input type="text" name = "u_phone" required ="required" value= "<?php echo $user_phone ; ?>" />
                            </td> 
                        </tr>             

                        

                        <tr>
                            <td align="right"> Country: </td>
                            <td>
                                <input type="text" name = "u_country" required ="required" value= "<?php echo $user_country ; ?>" />
                            </td> 
                        </tr>
                        <tr>
                            <td align="right"> Street: </td>
                            <td>
                                <input type="text" name = "u_street" required ="required" value= "<?php echo $user_street ; ?>" />
                            </td> 
                        </tr>
                        <tr>
                            <td align="right"> City: </td>
                            <td>
                                <input type="text" name = "u_city" required ="required" value= "<?php echo $user_city ; ?>" />
                            </td> 
                        </tr>
                        <tr>
                        <tr>
                            <td align="right"> State: </td>
                            <td>
                                <input type="text" name = "u_state" required ="required" value= "<?php echo $user_state ; ?>" />
                            </td> 
                        </tr>
                            <td align="right"> ZipCode: </td>
                            <td>
                                <input type="text" name = "u_zip" required ="required" value= "<?php echo $user_zip ; ?>" />
                            </td> 
                        </tr>
                        <tr align="center">
                            <td colspan="6">
                                <input style="width:100px;" type ="submit" name = "update" value="Update">
                            </td>
                            <td colspan="6">
                                <input style="width:100px;" type ="submit" name = "delete" value="Delete profile">
                            </td>
                        </tr>

                        
                    </table>                    
                    </form>
                    <?php
                        if(isset($_POST['update']))
                        {
                            $new_name = $_POST['u_name'];
                            $new_lastName = $_POST['l_name'];
                            $new_email = $_POST['u_email']; 
                            $new_phone = $_POST['u_phone'];
                            $new_password = $_POST['u_password'];
                            $new_street = $_POST['u_street']; 
                            $new_city = $_POST['u_city'];
                            $new_state = $_POST['u_state'];
                            $new_country = $_POST['u_country'];
                            $new_zip = $_POST['u_zip']; 
                            
                            $update_query = "update profile set user_fname= '$new_name',
                                                                user_lname = '$new_lastName',
                                                                user_email = '$new_email',
                                                                user_phone ='$new_phone',
                                                                user_password ='$new_password',
                                                                user_street = '$new_street',
                                                                user_city = '$new_city',
                                                                user_state = '$new_state',
                                                                user_country = '$new_country',
                                                                user_zip = '$new_zip'
                                                                where user_id = '$user_id'
                                                                ";
                            $query = mysqli_query($con, $update_query);
                            if($query)
                            {
                                echo "<script>alert('Information updated successfully.'); </script>";
                                echo "<script>window.open('home.php','_self'); </script>";

                            }
                            else{
                                echo "<script>alert('Error occured!!! Please try again !!!'); </script>";

                            }

                        }
                    ?>
                    <?php
                        if(isset($_POST['delete']))
                        {
                            $del_email = $_POST['u_email']; 
                           
                            $del_query = "DELETE FROM profile WHERE profile.user_email= '$del_email'";
                            $query1 = mysqli_query($con, $del_query);

                            $del_query2 = "DELETE FROM page WHERE page.profile_id= '$user_id'";
                            $query2 = mysqli_query($con, $del_query2);

                            $del_query3 = "DELETE FROM likes WHERE likes.liked_by= '$user_id'";
                            $query3 = mysqli_query($con, $del_query3);

                            $del_query4 = "DELETE FROM comments WHERE comments.user_id= '$user_id'";
                            $query4 = mysqli_query($con, $del_query4);

                            $del_query5 = "DELETE FROM posts WHERE posts.profile_id= '$user_id'";
                            $query5 = mysqli_query($con, $del_query5);

                            if($query1 && $query2 && $query3 && $query4 && $query5)
                            {
                                echo "<script>alert('Account deleted successfully'); </script>";
                                echo "<script>window.open('index.php','_self'); </script>";

                            }
                            else{
                                echo "<script>alert('Error occured deleting profile!!! Please try again !!!'); </script>";

                            }

                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
<?php } ?>