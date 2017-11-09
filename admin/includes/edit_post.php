<?php
    if(isset($_GET["id"])){
        $id     = $_GET["id"];
        $query  = "SELECT * FROM posts WHERE post_id = $id";
        $result = mysqli_query($connection, $query);
        $row    = mysqli_fetch_assoc($result);
        
        $title       = $row["post_title"];
        $category_id = $row["post_category_id"];
        $author      = $row["post_author"];
        $status      = $row["post_status"];
        $image       = $row["post_image"];
        $tags        = $row["post_tags"];
        $content     = $row["post_content"];
    }

    if(isset($_POST["update_post"])){
        $title       = $_POST["title"];
        $category_id = $_POST["post_category"];
        $author      = $_POST["author"];
        $status      = $_POST["post_status"];
        $image       = $_FILES["image"]["name"];
        $image_temp  = $_FILES["image"]["tmp_name"];
        $tags        = $_POST["post_tags"];
        $content     = $_POST["post_content"];
        
        move_uploaded_file($image_temp, "../images/$image");
        
        if(empty($image)){
            $query = "SELECT * FROM posts WHERE post_id = $id";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            $image = $row["post_image"];
        }
        
        $query = "UPDATE posts SET post_title = '$title', post_category_id = $category_id, post_date = now(), post_author = '$author', post_status = '$status', post_tags = '$tags', post_content = '$content', post_image = '$image' WHERE post_id = $id";
        
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not update post. Please try again.</div>';
        } else{
            echo "<div class='alert alert-success' role='alert'>Post updated. <a href='../post.php?p_id={$id}'>View Post</a></div>";
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title:</label>
        <input id="title" type="text" class="form-control" name="title" value="<?php echo $title ?>">
    </div>
    <div class="form-group">
        <label>Post Category:</label>
        <select name="post_category" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $cat_title = $row["cat_title"];
                    $cat_id = $row["cat_id"];
                    if($category_id == $cat_id){ // MAKE THE CURRENT CAT TITLE ACTIVE
                        echo "<option selected='selected' value='$cat_id'>$cat_title</option>";
                    } else{
                        echo "<option value='$cat_id'>$cat_title</option>";   
                    }
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author:</label>
        <input id="author" type="text" class="form-control" name="author" value="<?php echo $author ?>">
    </div>
    <div class="form-group">
        <label>Post Status:</label><br>
        <label for="published">
            <input id="published" type="radio" name="post_status" value="Published"<?php if($status == "Published"){
                                        echo "checked";
                                    } ?>>Publish
        </label><br>
        <label for="draft">
            <input id="draft" type="radio" name="post_status" value="Draft"    <?php if($status == "Draft"){
                    echo "checked";
                } ?>>Draft
        </label>
    </div>
    <div class="form-group">
        <label>Image:</label>
        <img width="100" src="../images/<?php echo $image; ?>" alt="Image">
        <input class="btn" id="post_ima ge" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags:</label>
        <input id="post_tags" type="text" class="form-control" name="post_tags" value="<?php echo $tags ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content:</label>
        <textarea id="post_content" class="form-control" name="post_content" rows="10" cols="30"><?php echo $content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update">
    </div>
</form>
