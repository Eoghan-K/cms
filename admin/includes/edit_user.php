<?php
    if(isset($_POST["edit_user"])){
        $user_id        = $_GET["id"];
        $username       = $_POST["username"];
        $user_firstname = $_POST["user_firstname"];
        $user_lastname  = $_POST["user_lastname"];
        $user_email     = $_POST["user_email"];
        $user_role      = $_POST["user_role"];
        $user_password  = $_POST["user_password"];
        
        $query = "SELECT randSalt FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $salt = $row["randSalt"];
        $hashed_password = crypt($user_password, $salt);
        
        $query = "UPDATE users SET username = '$username', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', user_role = '$user_role', user_password = '$hashed_password' WHERE user_id = $user_id";
        
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not update user. Please try again.</div>';
        } else{
            echo '<div class="alert alert-success" role="alert">User updated.</div>';
        }
    }
    
    if(isset($_GET["id"])){
        $user_id = $_GET["id"];
        $query   = "SELECT * FROM users WHERE user_id = $user_id";
        $result  = mysqli_query($connection, $query);
        $row     = mysqli_fetch_assoc($result);
        
        $first_name    = $row["user_firstname"];
        $last_name     = $row["user_lastname"];
        $username      = $row["username"];
        $user_role     = $row["user_role"];
        $user_email    = $row["user_email"];
        $user_password = $row["user_password"];
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstName">First Name:</label>
        <input id="user_firstName" type="text" class="form-control" name="user_firstname" value="<?php echo $first_name ?>">
    </div>
    <div class="form-group">
        <label for="user_lastName">Last Name:</label>
        <input id="user_lastName" type="text" class="form-control" name="user_lastname" value="<?php echo $last_name ?>">
    </div>
    <div class="form-group">
        <label>User Role:</label>
        <select name="user_role" class="form-control" required>
            <option value='Admin'<?php  // SELECT CURRENT USER ROLE
                        if($user_role == "Admin"){
                            echo "selected='selected'";
                        }
                    ?>>Admin</option>
            <option value='Subscriber'<?php  // SELECT CURRENT USER ROLE
                        if($user_role == "Subscriber"){
                            echo "selected='selected'";
                        }
                    ?>>Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input id="username" type="text" class="form-control" name="username" value="<?php echo $username ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email:</label>
        <input id="user_email" type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password:</label>
        <input id="user_password" type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
    </div>
<!--
    <div class="form-group">
        <label for="post_image">Post Image:</label>
        <input id="post_image" type="file" name="image">
    </div>
-->
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>
