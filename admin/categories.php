<?php  include "includes/admin_header.php"; ?>


    <div id="wrapper">
<?php if ($connection)
    echo "Okay There is a connection"; ?>
        <!-- Navigation -->
 <?php  include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to My Admin
                            <small>Mayoura</small>
                        </h1>
                        
                <div class="col-xs-6">
                   
                   <?php insertCategories();  ?>
                   
                   
                    <form action="" method="post">
                    
                     <div class="form-group">
                        <label for="cat_title">Add Category</label>
                        <input type="text" class="form-control" name="cat_title">
                    </div>
                    <div class="form-group">
                       <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                    </div>
                        
                    </form>
               </div>
                
               <?php 
                        
                    if(isset($_GET['edit'])){
                        $cat_id=$_GET['edit'];
                        include "includes/update_categories.php";
                    }
                        
                        ?>
  
              </div> 

               <div class="col-xs-6">
    
                   <table class="table table-bordered table">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Catgory Title</th>
                           </tr>
                       </thead>
                       <tbody>
                          
                 <?php findAllCategories(); ?>
                              
                          <?php
                        
                           
                              if(isset($_GET['delete'])){
                               $the_cat_id=$_GET['delete'];
                               $query="DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                               $delete_query=mysqli_query($connection,$query);
                                  header("location: categories.php");  // Refresh To prevent double click on delete
                               
                           }
                           ?>
                           
                         
                           
                       </tbody>
                   </table>
                   
                   
               </div>
                
                  </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php  include "includes/admin_footer.php"; ?>