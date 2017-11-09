<?php
    if(isset($_POST["create_user"])){
        $username       = $_POST["username"];
        $user_firstname = $_POST["user_firstname"];
        $user_lastname  = $_POST["user_lastname"];
        $user_email     = $_POST["user_email"];
        $password       = $_POST["user_password"];
        $user_role      = $_POST["user_role"];
        
        $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role) VALUES ('$username', '$user_firstname', '$user_lastname', '$user_email', '$password', '$user_role')";
        
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not add user. Please try again.</div>';
        } else{
            echo '<div class="alert alert-success" role="alert">User successfully added.</div>';
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstName">First Name:</label>
        <input id="user_firstName" type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastName">Last Name:</label>
        <input id="user_lastName" type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label>User Role:</label>
        <select name="user_role" class="form-control" required>
            <option value=''>Select Role</option>
            <option value='Admin'>Admin</option>
            <option value='Subscriber'>Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input id="username" type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email:</label>
        <input id="user_email" type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password:</label>
        <input id="user_password" type="password" class="form-control" name="user_password">
    </div>
<!--
    <div class="form-group">
        <label for="post_image">Post Image:</label>
        <input id="post_image" type="file" name="image">
    </div>
-->
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
