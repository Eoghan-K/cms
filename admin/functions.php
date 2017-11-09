<?php

    function createCategory(){
        global $connection;
        if(isset($_POST["submit"])){
            $cat_title = mysqli_real_escape_string($connection, $_POST["cat_title"]);
            if($cat_title == "" || empty($cat_title)){
                echo '<div class="alert alert-danger" role="alert">Category Title is Required</div>';
            } else{
                $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
                $result = mysqli_query($connection, $query);
                if(!$result){
                    echo '<div class="alert alert-danger" role="alert">Error. Please try again.</div>';
                } else{
                    echo '<div class="alert alert-success" role="alert">Category Added</div>';   
                }
            }
        }
    }

    function showAllCategories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result)){
            $cat_title = $row["cat_title"];
            $cat_id = $row["cat_id"];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a class='btn btn-danger btn-xs' href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a class='btn btn-warning btn-xs' href='categories.php?update={$cat_id}'>Edit</a></td>";
            echo "</tr>";
        }
    }

    function deleteCategory(){
        global $connection;
        if(isset($_GET["delete"])){
            $cat_id = $_GET["delete"];
            $query = "DELETE FROM categories WHERE cat_id = $cat_id LIMIT 1";
            $result = mysqli_query($connection, $query);
            if(!$result){
                echo '<div class="alert alert-danger" role="alert">Could not delete category. Please try again.</div>';
            } else{
                header("Location: categories.php");
            }
        }
    }

?>