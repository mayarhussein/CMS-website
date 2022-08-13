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
                    
               $view_query="UPDATE posts SET post_views_count=post_views_count +1 WHERE post_id={$the_post_id}";
                
                $send_query=mysqli_query($connection,$view_query);
                    
                
                if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin')
                $query="SELECT * FROM posts WHERE post_id={$the_post_id}";
                else
                $query="SELECT * FROM posts WHERE post_id={$the_post_id} AND post_status='published'"; 

                $result=mysqli_query($connection,$query);


                if(mysqli_num_rows($result)<1)
                echo "<h1 class='text-center'>No Posts Available</h1>";
                else{


                    while($row=mysqli_fetch_assoc($result)){
                        $post_title=$row['post_title'];
                        $post_author=$row['post_author'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];
                                                      
                        
                    
                     ?>

               
             

                <h1 class="page-header">Posts </h1>
                <!-- A Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                 <a href="author_posts.php?post_author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content;   ?></p>
                

                <hr>
                
                 <?php } 
                
              
                
                
                ?>
                 
                 
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
                 
                 
                 
                  <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                       <div class="form-group">
                       <label for="comment_author"> Author</label>
                     <input type="text" name="comment_author" class="form-control">
                       </div>
                       <div class="form-group">
                         <label for="comment_email"> Email</label>
                          <input type="email" name="comment_email" class="form-control" >
                       </div>
                       
                       
                        <div class="form-group">
                           <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

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
                
                
                

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                          <?php echo $comment_content; ?>
                    </div>
                </div>

                
                <?php } } }
                
                else{
                    
                    header("Location: index.php");
                    
                }
                ?>

                
              

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
