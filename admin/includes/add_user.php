<?php
if (isset($_POST['submit'])){
$user_firstname=$_POST['firstname'];
$user_lastname=$_POST['lastname'];
$user_role=$_POST['role'];
$username=$_POST['username'];   
$user_email=$_POST['email'];
$user_password=$_POST['password'];
    
$user_image=$_FILES['image']['name'];
$user_image_temp=$_FILES['image']['tmp_name'];
move_uploaded_file($user_image_temp,"../images/$user_image");
    
 $user_password=password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));

    

$query="INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password,user_image) ";
    
$query.="Values('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}','{$user_image}')";
    
    
    
    
    $Create_User=mysqli_query($connection,$query);
    
    
    if(!$Create_User)
        die("Query Failed" .mysqli_error($connection) );
    else
        echo "User Created: ".""."<a href='users.php'>View Users</a>";
    
    
}
    


?>
  

  
  <form action="" method="post" enctype="multipart/form-data" >

      <div class="form-group">
     <label for="firstName">First Name</label>
      <input type="text" name="firstname" class="form-control" >
    </div>  
    
      <div class="form-group">
     <label for="lastName">Last Name</label>
      <input type="text" name="lastname" class="form-control" >
    </div> 
    
    
    <div class="form-group">
        <select name='role' id='' >
           <option value='subscriber'>Select Options</option>
           <option value='admin'>Admin</option>
           <option value='subscriber'>Subscriber</option>
            
        </select>
    </div>
    
      <div class="form-group">
     <label for="image">User Image</label>
      <input type="file" name="image" >
    </div> 
    
   
     <div class="form-group">
     <label for="tags">username</label>
      <input type="text" name="username" class="form-control" >
    </div> 
    
    
     <div class="form-group">
     <label for="content">email</label>
      <input type="text" name="email" class="form-control" >
    </div> 
    
     <div class="form-group">
     <label for="content">password</label>
      <input type="password" name="password" class="form-control">
    </div> 
    
    <div class="form-group">
    <input type="submit" name="submit" value="Add User" class="btn btn-primary" >
    </div> 
    
    
    
    
    
    
    
    
    
</form>