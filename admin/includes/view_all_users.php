<?php  include("delete_modal.php");
 ?>
               <table class="table table-bordered table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Change to Admin</th>
                        <th>Change to Subscriber</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                     
                       
                        

                    </tr>
                </thead>
                <tbody>
                   <?php   
                    
                    $query="SELECT * FROM users";
                    $select_users=mysqli_query($connection,$query);


                    while($row=mysqli_fetch_assoc($select_users)){
                         $user_id=$row['user_id'];
                         $username=$row['username'];
                         $user_password=$row['user_password'];
                         $user_firstname=$row['user_firstname'];
                         $user_lastname=$row['user_lastname'];
                         $user_email=$row['user_email'];
                         $user_role=$row['user_role'];
                         $user_image=$row['user_image'];
                        

                        echo "<tr>";
                        echo "<td>{$user_id}</td>";
                        echo "<td>{$username}</td>";
                        echo "<td>{$user_firstname}</td>";
                        echo "<td>{$user_lastname}</td>";
                        echo "<td> <img src='../images/{$user_image}' width=40  alt='image' </td>";
                        echo "<td>{$user_email}</td>";
                        echo "<td>{$user_role}</td>";
?>
                    <form method='post'>
                    <input type="hidden" name="user_id"  value="<?php  echo $user_id;  ?>" >
                    <td> <input class="btn btn-info" type="submit" name="admin" value="Admin">   </td>
                    <td> <input class="btn btn-info" type="submit" name="subscriber" value="Subscriber" >   </td>
                    <td><a class="btn btn-info" href="users.php?source=edit_user&user_id=<?php echo $user_id; ?>">Edit</a></td>
                    <td> <input class="btn btn-info" type="submit" name="delete"  value="Delete">   </td>


                    </form>

                            
                  
<?php
                        echo "</tr>";

                    }
                  //GET METHOD
    /*echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";         
    echo "<td><a href='users.php?subscriber={$user_id}'>Subscriber</a></td>"; 
    echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
    echo "<td><a rel='$user_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";  
    */ 
                   

                    ?>

                </tbody>

            </table>  

           <?php
 if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin' ){  // security


 if(isset($_POST['delete'])){     // POST is more secure than GET
     $user_id=mysqli_real_escape_string($connection,$_POST['user_id']);  // security
     $query="DELETE FROM users WHERE user_id={$user_id} ";
     $deleteQuery=mysqli_query($connection,$query);
     header("location: users.php");
     }
     
 


if(isset($_POST['admin'])){
    $user_id=mysqli_real_escape_string($connection,$_POST['user_id']);
    $query="UPDATE users SET user_role='admin' WHERE user_id=$user_id";
    $admin_query=mysqli_query($connection,$query);
    header("location: users.php");
    
    
}




if(isset($_POST['subscriber'])){
    $user_id=mysqli_real_escape_string($connection,$_POST['user_id']);
    $query="UPDATE users SET user_role='subscriber' WHERE user_id=$user_id";
    $subscriber_query=mysqli_query($connection,$query);
    header("location: users.php");
    
    
}

 }

?>



<script>   // New Delete Button
$(document).ready(function(){
               $(".delete_link").on('click',function(){
                                    
                             var id=$(this).attr("rel");
                             var delete_url="users.php?delete="+id;
                   $(".modal_delete_link").attr("href",delete_url);
                   $("#myModal").modal('show');
                   
                                    
                                    });   

                  });

</script>

