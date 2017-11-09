<?php 
    if(isset($_GET["update"])){
        $cat_id = $_GET["update"];
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $edit_cat_title =  $row["cat_title"];
    }
?>   

<form action="" method="post">
    <div class="form-group">
        <label for="edit-cat-title">Edit Category:</label>
        <input id="edit-cat-title" class="form-control" type="text" name="edited_cat_title" required value="<?php if(isset($edit_cat_title)){echo $edit_cat_title;} ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>

<?php 
    if(isset($_POST["update"])){
        $edited_cat_title = mysqli_real_escape_string($connection, $_POST["edited_cat_title"]);
        $query = "UPDATE categories SET cat_title = ('$edited_cat_title') WHERE cat_id = $cat_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Update failed. Please try again.</div>';
        }
    }
?>