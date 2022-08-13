<?php

function escape($string){  // BEFORE GOING ONLINE: TO PROTECT FROM HACKERS  (before getting into the db)
    global $connection;
    return mysqli_real_escape_string($connecction,trim($string));   // trim html tags
 
}


function insertCategories(){
    
    global $connection;   // IMPORTANT
if(isset($_POST['submit'])){
                       $cat_title=$_POST['cat_title'];
                    
                    if ($cat_title =="" || empty($cat_title))
                        echo "Invalid category title";
                        else{
                            $query="INSERT INTO categories(cat_title) ";
                            $query.="VALUE('{$cat_title}')";
                            
                            $CreateCat=mysqli_query($connection,$query);
                            
                            
                    if(!$CreateCat)
                        die("Error".mysqli_error($connection));
                            
                        }
                    
                   }

}

function findALLCategories(){
    global $connection;
    
       $query="SELECT * FROM categories";
                   $select_categories=mysqli_query($connection,$query);
    while ($row=mysqli_fetch_assoc($select_categories)){
                $cat_title=$row['cat_title'];
                $cat_id=$row['cat_id'];
                echo "<tr>";
                echo "<td>{$cat_title}</td>";
                echo "<td>{$cat_id}</td>";
                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a> </td>";
                echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>" ;
                echo "</tr>";
                                      
                                  
                                  
                              }
    
}


function online_users(){
    
    if(isset($_GET['onlineusers'])){   // if isset get request
    
     global $connection;
        session_start();
        
        if(!$connection)
            
            include("../includes/db.php");
            
    
    $session=session_id();
    $time=time();
    $time_out_in_seconds=60; // after that, automatically logged out
    $time_out=$time- $time_out_in_seconds;
    
    $query="SELECT * FROM users_online WHERE session='$session' ";
    $send_query=mysqli_query($connection,$query);
    $count=mysqli_num_rows($send_query);
    
    if($count==NULL || $count == 0){   // if no users
        $query="INSERT INTO users_online(session,time) VALUES ('$session','$time') ";
        $session_query=mysqli_query($connection,$query);

    }
    else{       // if there is already a user, update
       $query="UPDATE users_online SET time='$time' WHERE session='$session' ";
        $session_query=mysqli_query($connection,$query);

    }
        
    
    
    $query="SELECT * FROM users_online WHERE time >'$time_out'";
    $users_online_query=mysqli_query($connection,$query);
     echo $users_count=mysqli_num_rows($users_online_query);
    
    
    
     }
    
  
    
    
    
    
}


online_users();

function getCount1($table){      // get the number of rows(elements) in a table
global $connection;

$query="SELECT * FROM $table";
                    $result=mysqli_query($connection,$query);
                    $count= mysqli_num_rows($result);
                    return $count;

}

 function getCount2($table,$str1,$str2){
    global $connection;
    $query="SELECT * FROM $table WHERE $str1 = '$str2'";
    $result=mysqli_query($connection,$query);
    return mysqli_num_rows($result);


}



function is_admin($username){
    global $connection;
    $query="SELECT user_role FROM users WHERE username='$username' ";
    $result=mysqli_query($connection,$query);

    $row=mysqli_fetch_array($result);

    if($row['user_role']=='admin')
    return true;
    else
    return false;

}

function checkUsername($username){      // checking for duplication
global $connection;
$query="SELECT username FROM users WHERE username='$username'";
$result=mysqli_query($connection,$query);
if(mysqli_num_rows($result)<1)      // if no identical username in DB
return true;
else 
return false;

}





function checkEmail($email){      // checking for duplication
    global $connection;
    $query="SELECT user_email FROM users WHERE user_email='$email'";
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result)<1)
    return true;
    else
    return false;
    
    }


function register($username,$password,$email){

    global $connection;

    $username= mysqli_real_escape_string($connection,$username);  // for hackers: to prevent sql injections
    $email=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);   
        
     $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));
    
    
        //Another way of encrypting password
    
        
 /*   $query="SELECT randSalt FROM users";    // check password encryption
    $select_randSalt_query=mysqli_query($connection,$query);
    if(!$select_randSalt_query)
        die('Query Failed'.mysqli_error($connection));
    
    $row=mysqli_fetch_array($select_randSalt_query);  //we're getting first row only so we wont use while loop
     $salt=$row['randSalt'];
     //$password=crypt($password,$salt);  //encryption
     
    */
    
    $query="INSERT INTO users(username,user_email,user_password,user_role)";
    $query.="VALUES('{$username}','{$email}','{$password}','admin')";
    $register_user_query=mysqli_query($connection,$query);
    if(!$register_user_query)
        die('Query Failed'.mysqli_error($connection).''.mysqli_errno($connection));
        
     }




    
function login($username,$password){
    
    global $connection;
    $username=mysqli_real_escape_string($connection,$username);  //cleaning up: in case hackers are trying to inject sql statements
    $password=mysqli_real_escape_string($connection,$password);
        
        $query="SELECT * FROM users WHERE username='{$username}'";
        $select_query=mysqli_query($connection,$query);
        
        if(!$select_query)
            die("Query Failed".mysqli_error($connection));
        
    
    
    
    while($row=mysqli_fetch_assoc($select_query)){
        
        $db_user_id=$row['user_id'];
        $db_username=$row['username'];
        $db_user_password=$row['user_password'];
        $db_user_firstname=$row['user_firstname'];
        $db_user_lastname=$row['user_lastname'];
        $db_user_role=$row['user_role'];
        
        
    }
    //$password=crypt($password,$db_user_password); // Decryption
    
    
    if (password_verify($password, $db_user_password)){  //New way of verification
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_user_firstname;
        $_SESSION['lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
        
        //    if($_SESSION['user_role']=='admin')
        //  header("Location:../admin");
        // else
            header("Location:/cms/admin");
            
    }
        
    
    else
        header("Location:/cms/index.php");
        
}


?>