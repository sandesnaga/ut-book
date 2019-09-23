
<?php 
    include("includes/connection.php");
    $query = "select * form posts";
    $result = mysqli_query($con, $query);

    $total_posts = $result->num_rows;

    $total_pages = ceil($total_posts / $per_page);
    //moving to the first page
    echo"
    <center>   
    <div id= 'pagination'>
    <a href = 'home.php?page=1'> First Page </a>";

             for($i=1;$i<= $total_pages;$i++)
            {
             echo "<a href= 'home.php?page=$i'> $i </a>";
            }
                //traversing to the last page
             echo "<a href='home.php?page=$total_pages'>Last Page</a>
     </center> 
    </div> ";
?>