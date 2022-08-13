<?php
if (isset($_POST['submit'])){
$post_title=$_POST['title'];
$post_user=$_POST['post_user']; 
$post_category_id=$_POST['category'];
$post_status=$_POST['status']; 
    
$post_image=$_FILES['image']['name'];
$post_image_temp=$_FILES['image']['tmp_name'];
    
$post_tags=$_POST['tags'];
$post_content=$_POST['content'];
$post_date=date('d-m-y');
  

    
    move_uploaded_file($post_image_temp,"../images/$post_image");
    

$query="INSERT INTO posts(post_title,post_user,post_category_id,post_status,post_image,post_tags,post_content,post_date) ";
    
$query.="Values('{$post_title}','{$post_user}',{$post_category_id},'{$post_status}','{$post_image}','{$post_tags}','{$post_content}',now())";
    
    
    
    
    $Create_Post=mysqli_query($connection,$query);
    
    
    if(!$Create_Post)
        die("Query Failed" .mysqli_error($connection) );
    
    
    $the_post_id=mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>POST CREATED.<a href='../post.php?p_id={$the_post_id}'>VIEW POST</a>  or  <a href='posts.php'>EDIT ANOTHER POST</a></p> ";
    
}
    


?>
  

  
  <form action="" method="post" enctype="multipart/form-data" >
   
   <div class="form-group">
     <label for="title">Post Title</label>
      <input type="text" name="title" class="form-control" >
    </div>  
       

    
      <div class="form-group">
           <label for="category">Category</label>

     <select name="category" >
         <?php
         $query='SELECT * FROM categories';
         $select_categories=mysqli_query($connection,$query);
         
         if(!$select_categories)
             die("Query Failed ".mysqli_error($connection));
         
         while($row=mysqli_fetch_assoc($select_categories)){
             $cat_id=$row['cat_id'];
             $cat_title=$row['cat_title'];
             
             echo "<option value='{$cat_id}'>{$cat_title}</option>";
             
         }

         ?>
         

     </select>
    </div>  
    
    
    
    
    
    
     <div class="form-group">
     <label for="post_user">Users</label>
     <select name="post_user" id='' >
     <?php 
      $query="SELECT * from users";
      $select_users=mysqli_query($connection,$query);
         if(!$select_users)
             die("Query Failed".mysqli_error($connection));
         
         while($row=mysqli_fetch_assoc($select_users)){
             $username=$row['username'];
             $user_id=$row['user_id'];
             
       echo "<option value='{$username}'>{$username}</option>";

             
         }

   
         
         ?>
     
     
    </select>
     </div>  
     
    
     <div class="form-group">
     <label for="status">Status</label>
     <select name="status" id=""> 
     <option value="Published">Published </option>
     <option value="Draft">Draft</option> 
     
    </select>
    </div> 
    
      <div class="form-group">
     <label for="image">Post Image</label>
      <input type="file" name="image" >
    </div> 
    
    
     <div class="form-group">
     <label for="tags">Post Tags</label>
      <input type="text" name="tags" class="form-control" >
    </div> 
    
    
     <div class="form-group">
     <label for="content">Post Content</label>
     <textarea id="body" name="content" class="form-control"  cols='30'  rows='10' >
         </textarea>
    </div> 
    
    <div class="form-group">
    <input type="submit" name="submit" value="Create Post" class="btn btn-primary" >
    </div> 
    
    
    
    
    
    
    
    
    
</form>