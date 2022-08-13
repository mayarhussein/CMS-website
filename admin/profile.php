<?php  include "includes/admin_header.php"; ?>


<?php    

if(isset($_SESSION['username'])){
$username=$_SESSION['username'];

$query= "SELECT * FROM users WHERE username='{$username}'";
$select_profile_query=mysqli_query($connection,$query);
while($row=mysqli_fetch_array($select_profile_query)){
    
                         $user_id=$row['user_id'];
                         $username=$row['username'];
                         $user_password=$row['user_password'];
                         $user_firstname=$row['user_firstname'];
                         $user_lastname=$row['user_lastname'];
                         $user_email=$row['user_email'];
                         $user_role=$row['user_role'];
                         $user_image=$row['user_image'];
                        
    
}


}
?>


<?php 

if(isset($_POST['submit'])){

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname']; 
$username=$_POST['username']; 
$email=$_POST['email'];  
$password=$_POST['password'];
$role=$_POST['role'];
    
$user_image=$_FILES['image']['name'];
$user_image_temp=$_FILES['image']['tmp_name'];
    
    move_uploaded_file($user_image_temp,"../images/$user_image");
    
    if(empty($user_image)){
        $query="SELECT * FROM users WHERE username='{$username}'";
        $select_image=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($select_image))
            $user_image=$row['user_image'];
        
    }
    
    
    
    
 $query="UPDATE users SET ";
    $query.="user_firstname = '{$firstname}' , ";
    $query.="user_lastname = '{$lastname}' , ";
    $query.="username = '{$username}' , ";
    $query.="user_email = '{$email}' , ";
    $query.="user_password = '{$password}' , ";
    $query.="user_image = '{$user_image}' , ";
    $query.="user_role= '{$role}' ";
    $query.="WHERE username='{$username}'";
    
    $update_user=mysqli_query($connection,$query);
    
     if(!$update_user)
        die("Query Failed". mysqli_error($connection));

}


?>









    <div id="wrapper">
<?php if ($connection)
    echo "Okay"; ?>
        <!-- Navigation -->
 <?php  include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    
                    
                    <h1 class='page-header'> 
                    Welcome to admin 
                    
                    <small> <?php echo $username;   ?> </small>
                    </h1>
      
          
                       <form action="" method="post" enctype="multipart/form-data" >

      <div class="form-group">
     <label for="firstName">First Name</label>
      <input type="text" value='<?php echo $user_firstname; ?>' name="firstname" class="form-control" >
    </div>  
    
      <div class="form-group">
     <label for="lastName">Last Name</label>
      <input type="text" value='<?php echo $user_lastname; ?>' name="lastname" class="form-control" >
    </div> 
    
    
    <div class="form-group">
        <select name='role' id='' >
           <option value='subscriber'><?php echo $user_role; ?></option>
           <?php
           if( $user_role=='subscriber')
           echo "<option value='admin'>Admin</option>";
           else
           echo "<option value='subscriber'>Subscriber</option>";
               ?>
            
        </select>
    </div>
    
      <div class="form-group">
     <label for="image">User Image</label>
     <br> 
     <img src='../images/<?php echo $user_image; ?>' width=40>
      <input type="file" name="image"  >
    </div> 
    
   
     <div class="form-group">
     <label for="tags">username</label>
      <input type="text"  value='<?php echo $username; ?>' name="username" class="form-control" >
    </div> 
    
    
     <div class="form-group">
     <label for="content">email</label>
      <input type="text" value='<?php echo $user_email; ?>' name="email" class="form-control" >
    </div> 
    
     <div class="form-group">
     <label for="content">password</label>
      <input type="password" autocomplete="off" name="password" class="form-control">
    </div> 
    
    <div class="form-group">
    <input type="submit" name="submit" value="Update Profile" class="btn btn-primary" >
    </div> 

</form>
                    

                
                  </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php  include "includes/admin_footer.php"; ?>