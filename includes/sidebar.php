 <div class="col-md-4">
           
            <?php  
     
     
     if(isset($_POST["submit"])){
          $search = $_POST["search"];


     
     $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
     $searchResult=mysqli_query($connection,$query);
     
     if(!$searchResult)
         die("Error".mysqli_error($connection));
         
         $count=mysqli_num_rows($searchResult);
         if ($count==0)
             echo "<h1> No Result </h1>";
         else{
             
             
             
             
         }
     
    
     }
     ?>
               
                <!-- Blog Search Wall -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                
                 <!-- login -->




<div class="well">
  
    <?php 
if (isset($_SESSION['user_role'])){
     echo "<h4>Logged in as: <a href='admin'> {$_SESSION['username']} </a></h4>";
     echo "<a href='includes/logout.php' class='btn btn-primary'>Log Out</a>";

}

else{
?>
    <form action="includes/login.php" method="post">

    <div class="form-group">
<input name="username" type="text" class="form-control" placeholder="Enter Username">   
    </div>


  <div class="input-group">
<input name="password" type="password" class="form-control" placeholder="password"> 
      <span class="input-group-btn" >
         <button class="btn btn-primary" name="login" type="submit">Submit</button>
          
      </span>
     </div>
            </form>
<?php } ?>
                    
                </div>
                
                
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                   
                     <?php  
                    
                    $query="SELECT * FROM categories ";

                    $Categories_Sidebar=mysqli_query($connection,$query);

                    
                    
                    ?>
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                             <?php
                  while($row=mysqli_fetch_assoc($Categories_Sidebar)){
                          $cat_title=$row['cat_title'];
                          $cat_id=$row['cat_id'];
                                  

                     echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";  
                    }     
                                ?>
                            </ul>
                        </div>
                    
                       
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               <?php include "widget.php";  ?>

            </div>