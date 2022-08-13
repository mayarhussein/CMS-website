<?php


if(isset($_GET['user_id'])){
    $the_user_id=$_GET['user_id'];
 
   


$query="SELECT * FROM users WHERE user_id=$the_user_id";
$select_user=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_user)){
                         $user_id=$row['user_id'];
                         $username=$row['username'];
                         $user_password=$row['user_password'];
                         $user_firstname=$row['user_firstname'];
                         $user_lastname=$row['user_lastname'];
                         $user_email=$row['user_email'];
                         $user_role=$row['user_role'];
                         $user_image=$row['user_image'];

    
}

    


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
        $query="SELECT * FROM users WHERE user_id=$the_user_id";
        $select_image=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($select_image))
            $user_image=$row['user_image'];
        
    }
    
    
    //Another way of encrypting password
    
    /*
    $query="SELECT randSalt FROM users";
    $select_randsalt_query=mysqli_query($connection,$query);
    
    
    $row=mysqli_fetch_array($select_randsalt_query);
    $salt=$row['randSalt'];
    $hashed_password=crypt($user_password,$salt);
    
    
    if(!$select_randsalt_query)
        die("Query Failed".mysqli_error($connection));*/
    
    
    if(!empty($password)){
        
        
        
        if( $user_password !=$password)  // if you entered a new password (data base password doesnt match the new password)
         $hashed_password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));  // crypt the password
        
        
        $query="UPDATE users SET ";
    $query.="user_firstname = '{$firstname}' , ";
    $query.="user_lastname = '{$lastname}' , ";
    $query.="username = '{$username}' , ";
    $query.="user_email = '{$email}' , ";
    $query.="user_password = '{$hashed_password}' , ";
    $query.="user_image = '{$user_image}' , ";
    $query.="user_role= '{$role}' ";
    $query.="WHERE user_id={$the_user_id}";
    
    $update_user=mysqli_query($connection,$query);
    
     if(!$update_user)
        die("Query Failed". mysqli_error($connection));
        
        echo "User Updated "."<a href='users.php'>View Users</a>";

        
    }
    
    
    
    
 

}

}

else  // if not logged in
    header("location: index.php");


?>
  

  
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
           <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
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
      <input autocomplete="off" type="password"  name="password" class="form-control">
    </div> 
    
    <div class="form-group">
    <input type="submit" name="submit" value="Update User" class="btn btn-primary" >
    </div> 

</form>