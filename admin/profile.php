<?php include "includes/header.php" ?>
   
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <?php
                            if(isset($_SESSION["username"])){
                                $username = $_SESSION["username"];
                                $query    = "SELECT * FROM users WHERE username = '$username'";
                                $result   = mysqli_query($connection, $query);
                                if(!$result){
                                    echo '<div class="alert alert-danger" role="alert">Could not find user. Please try again.</div>';
                                } else{
                                    $row = mysqli_fetch_assoc($result);
                                    $user_id       = $row["user_id"];
                                    $first_name    = $row["user_firstname"];
                                    $last_name     = $row["user_lastname"];
                                    $username      = $row["username"];
                                    $user_role     = $row["user_role"];
                                    $user_email    = $row["user_email"];
                                    $user_password = $row["user_password"];

                                }
                            }

                            if(isset($_POST["edit_profile"])){
                                $username       = $_POST["username"];
                                $user_firstname = $_POST["user_firstname"];
                                $user_lastname  = $_POST["user_lastname"];
                                $user_email     = $_POST["user_email"];
                                $user_role      = $_POST["user_role"];
                                $user_password  = $_POST["user_password"];

                                $query = "UPDATE users SET username = '$username', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', user_role = '$user_role', user_password = '$user_password' WHERE user_id = $user_id";

                                $result = mysqli_query($connection, $query);
                                if(!$result){
                                    echo '<div class="alert alert-danger" role="alert">Could not update profile. Please try again.</div>';
                                } else{
                                    echo '<div class="alert alert-success" role="alert">Profile updated.</div>';
                                }
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
                                <input type="submit" class="btn btn-primary" name="edit_profile" value="Update Profile">
                            </div>
                        </form>

                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php" ?>