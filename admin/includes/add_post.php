<?php
    if(isset($_POST["create_post"])){
        $title = $_POST["title"];
        $category_id = $_POST["post_category"];
        $author = $_SESSION["username"];
        $status = $_POST["post_status"];
        $image = $_FILES["image"]["name"];
        $image_temp = $_FILES["image"]["tmp_name"];
        $tags = $_POST["post_tags"];
        $content = $_POST["post_content"];
        $date = date("d-m-y");
        
        move_uploaded_file($image_temp, "../images/$image");
        
        $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($category_id, '$title', '$author', now(), '$image', '$content', '$tags', '$status')";
        
        $result = mysqli_query($connection, $query);
        $post_id = mysqli_insert_id($connection);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not add post. Please try again.</div>';
        } else{
            echo "<div class='alert alert-success' role='alert'>Post added. <a href='../post.php?p_id={$post_id}'>View post</a></div>";
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title:</label>
        <input id="title" type="text" class="form-control" name="title">
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
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>
<!--
    <div class="form-group">
        <label for="author">Post Author:</label>
        <input id="author" type="text" class="form-control" name="author">
    </div>
-->
    <div class="form-group">
        <label>Post Status:</label><br>
        <label for="published"><input id="published" type="radio" name="post_status" value="Published">Publish</label><br>
        <label for="draft"><input id="draft" type="radio" name="post_status" value="Draft">Draft</label>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image:</label>
        <input id="post_image" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags:</label>
        <input id="post_tags" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content:</label>
        <textarea id="post_content" class="form-control" name="post_content" rows="10" cols="30"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
</form>
