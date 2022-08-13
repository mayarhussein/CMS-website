    <?php    include "db.php"; ?>
       
       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms">Homepage</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <?php  
                    
                    $query="SELECT * FROM categories";
                    
                    $result=mysqli_query($connection,$query);
                    
                    while($row=mysqli_fetch_assoc($result)){
                          $cat_title=$row['cat_title'];
                          $cat_id=$row['cat_id'];

                          $category_class='';
                          $registration_class='';

                          $current_page_name=basename($_SERVER['PHP_SELF']);   // gets the current page

                          if(isset($_GET['category']) && $_GET['category']==$cat_id )
                            $category_class='active';
                        else if ($current_page_name=='registration.php')
                            $registration_class='active';

                          
                    
                     echo "<li class='<?php echo $category_class; ?>'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";  
                    }
                    
                    ?>
                   
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                     <li class='<?php echo $category_class; ?>'>
                        <a href="/cms/registration">Registration</a>
                    </li>
                    
                    
                    <?php 
                    if (session_status() === PHP_SESSION_NONE)
                        session_start();
                        
                    if (isset($_SESSION['user_role'])){
                        if (isset($_GET['p_id'])){
                            $post_id=$_GET['p_id'];
                    
                    echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}' >Edit Post</a> </li>";
                            
                        }
                    }
                     ?>
             </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>