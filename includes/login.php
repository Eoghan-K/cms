<?php include "db.php" ?>
<?php session_start(); ?>

<?php  
    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo "An error occured, please try again.";
        } else{ // PULL USER DATA FROM DB
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["user_id"];
            $db_username = $row["username"];
            $user_password = $row["user_password"];
            $user_email = $row["user_email"];
            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];
            $user_role = $row["user_role"];
            
            $password = crypt($password, $user_password);
            
            if($password === $user_password){
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $db_username;
                $_SESSION["user_email"] = $user_email;
                $_SESSION["firstname"] = $user_firstname;
                $_SESSION["lastname"] = $user_lastname;
                $_SESSION["user_role"] = $user_role;
                
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
        }
    }
?>