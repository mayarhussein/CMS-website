<?php                 
             if(isset($_GET['p_id'])){
                 $the_post_id=$_GET['p_id'];
                 
                        $query="SELECT * FROM posts WHERE post_id= $the_post_id ";
                        $select_posts=mysqli_query($connection,$query);
                            
                            
             while($row=mysqli_fetch_assoc($select_posts)){
                     $post_id=$row['post_id'];
                     $post_user=$row['post_user'];
                     $post_title=$row['post_title'];
                     $post_category_id=$row['post_category_id'];
                     $post_status=$row['post_status'];
                     $post_image=$row['post_image'];
                     $post_tags=$row['post_tags'];
                     $post_content=$row['post_content'];
                     $post_comment_count=$row['post_comment_count'];
                     $post_date=$row['post_date'];


                }

if (isset($_POST['submit'])){
    
    
$post_title=$_POST['title'];
$post_user=$_POST['post_user']; 
$post_status=$_POST['status']; 
$post_category_id=$_POST['category'];    
$post_date=date('d-m-y');
    
$post_image=$_FILES['image']['name'];
$post_image_temp=$_FILES['image']['tmp_name'];
    
$post_tags=$_POST['tags'];
$post_content=$_POST['content'];
 
    
    move_uploaded_file($post_image_temp,"../images/$post_image");
    
    if(empty($post_image)){
        $query="SELECT * FROM posts WHERE post_id=$the_post_id";
        $select_image=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($select_image))
            $post_image=$row['post_image'];    
        
    }
    
    $query="UPDATE posts SET ";
    $query.="post_title = '{$post_title}' , ";
    $query.="post_user = '{$post_user}' , ";
    $query.="post_category_id = '{$post_category_id}' , ";
    $query.="post_status = '{$post_status}' , ";
    $query.="post_date = now(), ";
    $query.="post_image = '{$post_image}' , ";
    $query.="post_tags = '{$post_tags}' , ";
    $query.="post_content = '{$post_content}' ";
    $query.="WHERE post_id={$the_post_id}";
    
    $update_post=mysqli_query($connection,$query);
    
    if(!$update_post)
        die("Query Failed". mysqli_error($connection));
    
    
    echo "<p class='bg-success'>POST UPDATED.<a href='../post.php?p_id={$the_post_id}'>VIEW POST</a>  or  <a href='posts.php'>EDIT ANOTHER POST</a></p> ";
       
}    }
                 ?>
          
  <form action="" method="post" enctype="multipart/form-data" >
   
   <div class="form-group">
     <label for="title">Post Title</label>
      <input type="text" value='<?php echo $post_title; ?>' name="title" class="form-control" >
    </div>  
       

      <div class="form-group">
     <select name="category"  >
         <?php
         $query='SELECT * FROM categories';
         $select_categories=mysqli_query($connection,$query);
         
         if(!$select_categories)
             die("Query Failed ".mysqli_error($connection));
         
         while($row=mysqli_fetch_assoc($select_categories)){
             $cat_id=$row['cat_id'];
             $cat_title=$row['cat_title'];
             
            
             if($cat_id==$post_category_id)
             echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
             else
             echo "<option value='{$cat_id}'>{$cat_title}</option>";           
         }
         ?>
         
     </select>
    </div>  
    
    
     <div class="form-group">
     <label for="post_user">Users</label>
     <select name="post_user" id='' >
      <?php
       echo "<option value='{$post_user}'>{$post_user}</option>";

    ?> 
     <?php 
      $query="SELECT * from users";
      $select_users=mysqli_query($connection,$query);
         if(!$select_users)
             die("Query Failed".mysqli_error($connection));
         
         while($row=mysqli_fetch_assoc($select_users)){
             $username=$row['username'];
             $user_id=$row['user_id'];

             if($username==$post_user)
             echo "<option selected value='{$username}'>{$username}</option>";   
             else
             echo "<option value='{$username}'>{$username}</option>";            
         }  
         ?>
     
     
    </select>
     </div>
    
    
    <div class="form-group">
    <select name="status" id=''>
       
        <option value='<?php echo $post_status; ?>'> <?php echo $post_status;  ?> </option>
        <?php 
        if ($post_status=='Published')
            echo "<option value='Draft'> Draft </option>";
        else
            echo "<option value='Published'> Published </option>";
      
        ?>
        
        
    </select>
      </div>
      
    
    
    
    
      <div class="form-group">
    <img src="../images/<?php echo $post_image; ?>"  width='100'>
    <input type="file" name="image" >
    </div> 
    
    
     <div class="form-group">
     <label for="tags">Post Tags</label>
      <input type="text"  value='<?php echo $post_tags; ?>' name="tags" class="form-control" >
    </div> 
    
    
     <div class="form-group">
     <label for="content">Post Content</label>
      <textarea name="content" class="form-control"  cols='30'  rows='10' ><?php echo $post_content; ?>
         </textarea>
    </div> 
    
    <div class="form-group">
    <input type="submit" name="submit" value="Update Post" class="btn btn-primary" >
    </div> 

    
</form>