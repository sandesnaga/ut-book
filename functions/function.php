<?php
$con = mysqli_connect("localhost","root","root", "s_network") or die("Connection failed.");

//insert the post 
function insert_Post()
{
    if(isset($_POST['sub']))
    {
        global $con;
        global $user_id;
        $content = addslashes($_POST['content']);

        if($content == '')
        {
            echo"<h2> Please enter your post </h2>";
            exit();
        }
        else
        {
            $insert = "insert into posts (profile_id, post_comment, post_date, post_content)
                        value('$user_id', 'NULL', now(),'$content') ";
            $run = mysqli_query($con, $insert);

            if($run)
            {
                echo "<script>alert('Your post has been updated successfully') </script>";
                $update = "update profile set user_posts='yes' where user_id= '$user_id'";
                $run_update = mysqli_query($con, $update);
            }
        }
    }
}

//get the post 
function get_posts()
{
    global $con;
    global $user_id;
    global $user;
    $per_page = 4;

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    $start_from = ($page-1) * $per_page;
    $get_posts= "select * from posts WHERE profile_id='$user_id' ORDER by 1 DESC LIMIT $start_from, $per_page";

  $run_posts = mysqli_query($con, $get_posts);
    while($row_posts = mysqli_fetch_array($run_posts))
    {
        $post_id= $row_posts['post_id'];
        $user_id = $row_posts['profile_id'];
        $content = substr($row_posts['post_content'],0, 70);
        $post_date = $row_posts['post_date'];

        //user who posted
        $get_user = "SELECT * FROM profile WHERE user_email = '$user'";
        $run_user = mysqli_query($con,$get_user);
        $row = mysqli_fetch_array($run_user);
        $user_name= $row['user_fname'];
        $user_lname= $row['user_lname'];
        $user_image = $row['profile_picture']; 

       echo " 
            <div id= 'posts'>
                <p>
                <img src = 'users/$user_image' width = '80' height ='80'> </p>
                <h3> <a href='user_profile.php? u_id = $user_id'> $user_name </a>&nbsp<small style='color:black;'> 
                Updated a post on $post_date
                </small> </h3>
                <p style ='color:black;'> $content </p>
                <a href='single.php?post_id= $post_id' style = 'float:right;'>
                <button>
                Comment
                </button>
                </a>
            </div><br><br>";

    }
     include("pagination.php");
}



function single_post()
{  
    $post_id = $_GET['post_id'];
   
    if(isset($post_id))
    {
        //echo "<script>alert ('$post_id'); </script>";
        
        global $con;
        $get_id = $_GET['post_id'];
        $get_post = "select * from posts where post_id = '$get_id'";
        $run_post = mysqli_query($con, $get_post);
        $row_post = mysqli_fetch_array($run_post);
        $post_id = $row_post['post_id'];
        $user_id = $row_post['profile_id'];
        $comment = $row_post['post_content'];
        $post_date = $row_post['post_date'];
      //  echo "<script>alert ('$post_date'); </script>";
        
     
        $user = "select * from profile where user_id= '$user_id' and user_posts= 'yes'";

        $run_user = mysqli_query($con, $user);

        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_fname'];
        $user_image = $row_user['profile_picture'];

        //echo "<script>alert ('user name $user_name'); </script>";

        //getting the user email by the session variable

        $user_com = $_SESSION['user_email'];

        $get_com = "select * from profile where user_email= '$user_com'";
        $run_com = mysqli_query($con, $get_com);
        $row_com = mysqli_fetch_array($run_com);

        $user_com_id = $row_com['user_id'];
        $user_com_name = $row_com['user_fname'];

        //display the comments

        echo" 
            <div id= 'posts'>
                <p><img src= 'users/$user_image' width =' 80' height = '80' > </p>
                <h3><a href= 'user_profile.php?user_id=$user_id' >$user_name </a></h3>
                <p>Posted on: $post_date </p>
                <p>$comment </p>
            </div>";


            include ("functions/comment.php");
            echo "
            <br>
            <form method='POST' id= 'commentid'>
                <textarea cols='50' rows = '5' name= 'comment' placeholder= 'Comment on the post.....'></textarea>
                <br>
                <input type= 'submit' name='reply' value = 'Comment'>
                
            </form>";

            if(isset($_POST['reply']))
            {
                
                $comment = $_POST['comment'];

                $insert = "insert into comments(post_id,user_id,comment_content, comment_author, comment_date)
                values ('$post_id', '$user_id','$comment', '$user_com_name', now() ) ";

                $run = mysqli_query($con, $insert);
                
                echo "<script>alert ('reply posted successfully'); </script>";

                echo "<script> window.open('single.php?post_id=$post_id', '_self' );</script>";
            }
    }
    
} 

function user_posts()
{
    global $con;
    if(isset($_GET['u_id']))
    {
        $u_id = $_GET['u_id'];
    }

    $get_post ="select * from posts where profile_id = '$u_id' order by 1 DESC limit 5";
    $run_query = mysqli_query($con, $get_post);

    while($row_posts = mysqli_fetch_array($run_query))
    {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['profile_id'];
        $post_content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        $user_query = "select * from profile where user_id = '$user_id' and user_posts='yes'";

        $run_user_query = mysqli_query($con, $user_query);

        $users_row = mysqli_fetch_array($run_user_query);

        $userName = $users_row['user_fname'];
        $userImage = $users_row['profile_picture'];

        //echo "<script>alert('user name is $userName'); </script>";


        echo "<div id='posts' >
            <p>
            <img src = users/$userImage width=80 height= 80 > 
            </p>
            <h3> <a href= 'user_profile.php?user_id=$user_id'> $userName </a> </h3>
            <p> $post_date </p>
            <p>$post_content </p>

            <a href= 'single.php?post_id=$post_id' style= 'float:right;'> <button class= 'fa fa-address-book'>View</button> </a>
            <a href= 'edit_post?post_id=$post_id' style= 'float:right;'> <button class= 'fa fa-edit'>Edit</button> </a>
            <a href= 'delete_post.php?post_id=$post_id' style= 'float:right;'> <button class= 'fa fa-trash-o'>Delete</button> </a>
        </div><br><br>";

        include("delete_post.php");
        
    }

}

function create_page()
{
    if(isset($_GET['u_id']))
    {
        $user_id = $_GET['u_id'];
    }


}


//get the post 


?>

