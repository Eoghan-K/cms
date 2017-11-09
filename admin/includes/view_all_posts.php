<?php
    if(isset($_POST["checkBoxArray"])){
        foreach($_POST["checkBoxArray"] as $postValue_id){
            $bulk_options = $_POST["bulk_options"];
            switch($bulk_options){
                case "Published":
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValue_id";
                    $result = mysqli_query($connection, $query);
                    break;
                case "Draft":
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValue_id";
                    $result = mysqli_query($connection, $query);
                    break;
                case "delete":
                    $query = "DELETE FROM posts WHERE post_id = $postValue_id";
                    $result = mysqli_query($connection, $query);
                    break;
                case "clone":
                    $query = "SELECT * FROM posts WHERE post_id = $postValue_id";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        $author = $row["post_author"];
                        $title = $row["post_title"];
                        $category_id = $row["post_category_id"];
                        $status = $row["post_status"];
                        $image = $row["post_image"];
                        $tags = $row["post_tags"];
                        $content = $row["post_content"];
                    }
                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES('$category_id', '$title', '$author', now(), '$image', '$content', '$tags', '$status')";
                    $result = mysqli_query($connection, $query);
                    break;
            }
        }
    }
?>

<form action="" method="post">
    <div class="table-responsive">
        <table class="table table-hover">
           
            <div id="bulkOptionContainer" class="col-xs-4">
                <select class="form-control" name="bulk_options">
                    <option value="">Select Options</option>
                    <option value="Published">Publish</option>
                    <option value="Draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>
           
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM posts ORDER BY post_id desc";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row["post_id"];
                        $author = $row["post_author"];
                        $title = $row["post_title"];
                        $category_id = $row["post_category_id"];
                        $status = $row["post_status"];
                        $image = $row["post_image"];
                        $tags = $row["post_tags"];
                        $comment_count = $row["post_comment_count"];
                        $date = $row["post_date"];

                        // QUERY CATEGORY TITLE
                        $query = "SELECT * FROM categories WHERE cat_id = $category_id";
                        $category_query = mysqli_query($connection, $query);
                        $cat_title = mysqli_fetch_assoc($category_query)["cat_title"];

                        echo "<tr>";
                            echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$id'></td>";
                            echo "<td>{$id}</td>";
                            echo "<td>{$author}</td>";
                            echo "<td><a href='../post.php?p_id={$id}'>{$title}</a></td>";
                            echo "<td>{$cat_title}</td>";
                            echo "<td>{$status}</td>";
                            echo "<td><img width='100px' src='../images/{$image}' alt='Image'></td>";
                            echo "<td>{$tags}</td>";
                            echo "<td>{$comment_count}</td>";
                            echo "<td>{$date}</td>";
                            echo "<td><a class='btn btn-info btn-xs' href='posts.php?source=edit_post&id=$id'>edit</a></td>";
                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete the post?');\" class='btn btn-danger btn-xs' href='posts.php?delete={$id}'>Delete</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</form>

<?php
    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $query = "DELETE FROM posts WHERE post_id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not delete post. Please try again.</div>';
        } else{
            header("Location: posts.php");
        }
    }
?>