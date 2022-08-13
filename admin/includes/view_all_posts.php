<?php  
include("delete_modal.php");
if (isset($_POST['checkBoxArray'])){


foreach($_POST['checkBoxArray'] as $post_id){
$bulk_option=$_POST['bulk_options'];
//echo $post_id;
   
        if($bulk_option == 'Published' || $bulk_option == 'Draft' ) {
$query="UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id={$post_id}";
            $publish_draft_query=mysqli_query($connection,$query);
            if(!$publish_draft_query)
                die("Query Failed".mysqli_error($connection));
            
        }
    else if ($bulk_option == 'delete'){
        
        $query="DELETE FROM posts WHERE post_id={$post_id}";
        $delete_query=mysqli_query($connection,$query);
        if(!$delete_query)
            die('Query Failed'.mysqli_error($connection));
  
        
    }
    
    
    else if($bulk_option=='Clone'){
        
        $query="SELECT * FROM posts WHERE post_id={$post_id}";
        $select_post_query=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($select_post_query)){
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_username=$row['post_user']; 
            $post_category_id=$row['post_category_id'];
            $post_status=$row['post_status']; 
            $post_image=$row['post_image'];
            $post_tags=$row['post_tags'];
            $post_content=$row['post_content'];
            $post_date=$row['post_date'];
            
            
            
        }
        
        
    $query="INSERT INTO posts(post_title,post_author,post_user,post_category_id,post_status,post_image,post_tags,post_content,post_date) ";
    
$query.="Values('{$post_title}','{$post_author}','{$post_username}',{$post_category_id},'{$post_status}','{$post_image}','{$post_tags}','{$post_content}',now())";
    
    
    
    
    $Create_Post=mysqli_query($connection,$query);
    
    
    if(!$Create_Post)
        die("Query Failed" .mysqli_error($connection) );
        
        
        
        
        
    }
       
            
           
            
    }


}





?>


<form action="" method='post'>   

<table class="table table-bordered table">

<div id="bulkOptionContainer" class="col-xs-4">
<select class='form-control' name="bulk_options" id="">
<option value="">Select Options</option>
<option value="Published">Publish</option>
<option value="Draft">Draft</option>
<option value="delete">Delete</option>
<option value="Clone">Clone</option>
</select>

</div>                   

<div class="col-xs-4">
<input type='submit' name='submit' class="btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>



</div>                   





                <thead>
                    <tr>
    <th><input id="selectAllBoxes" type="checkbox"> </th>
                        <th>ID</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Viewers </th>
                        <th>Reset views</th>

                    </tr>
                </thead>
                <tbody>
                   <?php   
                    $query="SELECT * FROM posts ORDER BY post_id DESC";
                    $select_posts=mysqli_query($connection,$query);


                    while($row=mysqli_fetch_assoc($select_posts)){
                         $post_id=$row['post_id'];
                         $post_author=$row['post_author'];
                         $post_title=$row['post_title'];
                          $post_user=$row['post_user'];
                         $post_category_id=$row['post_category_id'];
                         $post_status=$row['post_status'];
                         $post_image=$row['post_image'];
                         $post_tags=$row['post_tags'];
                         $post_comment_count=$row['post_comment_count'];
                         $post_date=$row['post_date'];
                        $post_views_count=$row['post_views_count'];

                        if(empty($post_tags))
                        $post_tags='No tags';    // to prevent shifting in showing the data in the table

                        echo "<tr>";
                        ?>

                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                        <?php 
                        echo "<td>{$post_id}</td>";
                        
                        
                        echo "<td>{$post_user}</td>";
                         
                           
                        echo "<td>{$post_title}</td>";

                        $query="SELECT * From categories WHERE cat_id={$post_category_id}";

                        $select_categories=mysqli_query($connection,$query);

                        while($row=mysqli_fetch_assoc($select_categories)){
                           $cat_id=$row['cat_id'];
                            $cat_title=$row['cat_title'];

                        }

                        echo "<td>{$cat_title}</td>";




                        echo "<td>{$post_status}</td>";
                        echo "<td><img src='../images/{$post_image}' width=100  alt='image'</td>";
                        echo "<td>{$post_tags}</td>";
                        
                        $query="SELECT * FROM comments WHERE comment_post_id=$post_id";
                        $send_comment_query=mysqli_query($connection,$query);
                        $comments_count=mysqli_num_rows($send_comment_query);
                        
                        $row=mysqli_fetch_array($send_comment_query);
                        $comment_id=isset($row['comment_id']);
                        
                        
                        echo "<td><a href='post_comments.php?id=$post_id'>{$comments_count}</a></td>";
                        echo "<td>{$post_date}</td>";
                        echo "<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
 
                        ?> 
                    <form method='post'> 
                    <input type="hidden" name="post_id" value="<?php  echo $post_id;  ?>">
                    <td> <input class="btn btn-danger" type="submit" name="delete" value="Delete" ></td>
                    <td><?php echo $post_views_count; ?></td>
                    <td> <input class="btn btn-info" type="submit" name="reset_count" value="Reset Views" > </td>
                      
                     </form>

                       <?php 

                        echo "</tr>"; 

                    }

                    
                      // by Get method no form needed
                     //echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                     ///echo "<td><a href='posts.php?reset_count={$post_id}'>Reset Count<td/>";
                       
                     
                   




                    



                    ?>



                </tbody>

            </table>  
            </form> 
           <?php

    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){



if(isset($_POST['delete'])){     // POST instead of GET : more secure   
$post_id=mysqli_real_escape_string($connection,$_POST['post_id']);  // ESCAPING MORE SECURITY
$query="DELETE FROM posts WHERE post_id={$post_id}";
$deleteQuery=mysqli_query($connection,$query);   
header("location: posts.php");   // Refresh
        
    }

if(isset($_POST['reset_count'])){
    $post_id=$_POST['post_id'];
    $query="UPDATE posts SET post_views_count=0 WHERE post_id=".mysqli_real_escape_string($connection,$post_id)."";
    // Another better way is escaping
    $reset_query=mysqli_query($connection,$query);
    header("location: posts.php"); 

}
        
    }


?>

<script>
$(document).ready(function(){
               $(".delete_link").on('click',function(){
                                    
                             var id=$(this).attr("rel");
                             var delete_url="posts.php?delete="+id;
                   $(".modal_delete_link").attr("href",delete_url);
                   $("#myModal").modal('show');
                   
                                    
                                    });   

                  });

</script>







