<div class="table-responsive">
   <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $comment_id = $row["comment_id"];
                    $comment_author = $row["comment_author"];
                    $comment_content = $row["comment_content"];
                    $comment_email = $row["comment_email"];
                    $comment_post_id = $row["comment_post_id"];
                    $comment_date = $row["comment_date"];
                    $comment_status = $row["comment_status"];
                    
                    // QUERY POST TITLE
                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $post_query = mysqli_query($connection, $query);
                    $post_title = mysqli_fetch_assoc($post_query)["post_title"];

                    echo "<tr>";
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
                    echo "<td>{$comment_email}</td>";
                    echo "<td>{$comment_status}</td>";
                    echo "<td><a href='/cms/post.php?p_id=$comment_post_id'>{$post_title}</a></td>";
                    echo "<td>{$comment_date}</td>";
                    echo "<td><a class='btn btn-success btn-xs' href='comments.php?approve={$comment_id}'>Approve</a></td>";
                    echo "<td><a class='btn btn-warning btn-xs' href='comments.php?unnaprove={$comment_id}'>Unapprove</a></td>";
                    echo "<td><a class='btn btn-danger btn-xs' href='comments.php?delete={$comment_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    // DELETE COMMENT
    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $query = "DELETE FROM comments WHERE comment_id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Could not delete comment. Please try again.</div>';
        } else{
            header("Location: comments.php");
        }
    }

    // APPROVE COMMENT
    if(isset($_GET["approve"])){
        $comment_id = $_GET["approve"];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Error. Please try again.</div>';
        } else{
            header("Location: comments.php");
        }
    }

    // UNAPPROVE COMMENT
    if(isset($_GET["unnaprove"])){
        $comment_id = $_GET["unnaprove"];
        $query = "UPDATE comments SET comment_status = 'unnaproved' WHERE comment_id = $comment_id";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Error. Please try again.</div>';
        } else{
            header("Location: comments.php");
        }
    }
?>