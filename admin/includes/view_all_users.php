<div class="table-responsive">
   <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Change Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM users";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $user_id        = $row["user_id"];
                    $username       = $row["username"];
                    $password       = $row["user_password"];
                    $user_firstname = $row["user_firstname"];
                    $user_lastname  = $row["user_lastname"];
                    $user_email     = $row["user_email"];
                    $user_image     = $row["user_image"];
                    $user_role      = $row["user_role"];
                    
                    // CHECK CURRENT USER ROLE
                    if($user_role == "Admin"){
                        $change_role = "Subscriber";
                    } else{
                        $change_role = "Admin";
                    }

                    echo "<tr>";
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$user_firstname}</td>";
                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";
                    echo "<td>{$user_role}</td>";
                    echo "<td><a class='btn btn-warning btn-xs' href='users.php?change_role=$user_id&new_role=$change_role'>Make {$change_role}</a></td>";
                    echo "<td><a class='btn btn-info btn-xs' href='users.php?source=edit_user&id=$user_id'>edit</a></td>";
                    echo "<td><a class='btn btn-danger btn-xs' href='users.php?delete=$user_id'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    // DELETE USER
    if(isset($_GET["delete"])){
        $user_id = $_GET["delete"];
        $query = "DELETE FROM users WHERE user_id = $user_id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not delete user. Please try again.</div>';
        } else{
            header("Location: users.php");
        }
    }

    // CHANGE USER ROLE
    if(isset($_GET["change_role"])){
        $user_id = $_GET["change_role"];
        $new_role = $_GET["new_role"];
        $query = "UPDATE users SET user_role = '$new_role' WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not change user role. Please try again.</div>' . mysqli_error($connection);
        } else{
            header("Location: users.php");
        }
    }
?>