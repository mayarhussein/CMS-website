<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
    


<body>


    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php  
                
                if(isset($_GET['p_id'])){
                    $the_post_id=$_GET['p_id'];
                    $the_author=$_GET['post_author'];
                    
                }
                
                
                $query="SELECT * FROM posts WHERE post_user='{$the_author}'";
                $result1=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($result1)){
                        $post_title=$row['post_title'];
                        $post_user=$row['post_user'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];
                                                      
                        
                    
                     ?>

               
             

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    All Posts by <?php echo $post_user; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content;   ?></p>
                

                <hr>
                
                 <?php } ?>
                 
                 
                 <?php 
                if (isset($_POST['submit'])){
                  
                $the_post_id=$_GET['p_id'];    
                $comment_author=$_POST['comment_author'];  
                $comment_email=$_POST['comment_email'];
                $comment_content=$_POST['comment_content'];
                    
                    
                    if(!empty($comment_author) && !empty( $comment_email)  && !empty($comment_content) ){
                 
                $query="INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content,comment_status,comment_date)";
                
                $query.="VALUES ({$the_post_id},'{$comment_author}','{$comment_email}', '{$comment_email}','unapprove',now())";
                    
                $create_comment=mysqli_query($connection,$query);
                    
                    if(!$create_comment)
                        die("Query Failed".mysqli_error($connection));
                    
            $query="UPDATE posts SET post_comment_count= post_comment_count + 1";
            $query.=" WHERE post_id=$the_post_id";
            $update_comment_query=mysqli_query($connection,$query);  
                    
                    if(!$update_comment_query)
                        die("Query Failed".mysqli_error($connection));
                    
                    
                
                }
                    else
                        
                        echo "<script>alert('Fields can NOT be empty')</script>";
                
                }
                
                ?>
                 
                 
                 
               
                <!-- Posted Comments -->
                
                <?php  
                $query="SELECT * FROM comments where comment_post_id=$the_post_id ";
                $query.=" AND comment_status = 'approved' ";
                $query.= "ORDER BY comment_id DESC";
                $select_comment_query=mysqli_query($connection,$query);
                
                if(!$select_comment_query)
                    die("Query FAILED".mysqli_error($connection));
                
                while($row=mysqli_fetch_assoc($select_comment_query)){
                    $comment_author=$row['comment_author'];
                    $comment_content=$row['comment_content'];
                    $comment_date=$row['comment_date'];
                    
                
                
                
                
                ?>
                
                
                



                
                <?php } ?>

                
               
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php  include "includes/sidebar.php";  ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php  include "includes/footer.php"  ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
