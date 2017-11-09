<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/nav.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
                if(isset($_GET["p_id"])){
                    $post_id = $_GET["p_id"];
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $result = mysqli_query($connection, $query);

                    $row = mysqli_fetch_assoc($result);
                    $post_title = $row["post_title"];
                    $post_author = $row["post_author"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = $row["post_content"];
            ?>



                    <!-- First Blog Post -->
                    <h2>
                        <a href="#">
                            <?php echo $post_title; ?>
                        </a>
                    </h2>
                    <p class="lead">
                        by
                        <a href="index.php">
                            <?php echo $post_author; ?>
                        </a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on
                        <?php echo $post_date; ?>
                    </p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p>
                        <?php echo $post_content; ?>
                    </p>

                    <hr id="target">
                
                <!-- Blog Comments -->
                <?php
                    if(isset($_POST["create_comment"])){
                        $comment_content = $_POST["comment_content"];
                        
                        if(isset($_SESSION["user_id"])){
                            $comment_author = $_SESSION["username"];
                            $comment_email = $_SESSION["user_email"];
                        } else{
                            $comment_author = $_POST["comment_author"];
                            $comment_email = $_POST["comment_email"];
                        }
                        
                        $error_message = "";
                        if(empty($comment_author)){
                            $error_message .= "Author cannot be blank<br>";
                        }
                        if(empty($comment_email)){
                            $error_message .= "Email cannot be blank<br>";
                        }
                        if(empty($comment_content)){
                            $error_message .= "Content cannot be blank";
                        }
                        
                        if($error_message != ""){
                            echo "<div class='alert alert-danger' role='alert'>$error_message</div>";
                        } else{
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date) VALUEs ($post_id, '$comment_author', '$comment_email', '$comment_content', now())";
                        
                            $result = mysqli_query($connection, $query);

                            if(!$result){
                                echo '<div class="alert alert-danger" role="alert">Could not add comment. Please try again.</div>';
                            } else {
                                echo '<div class="alert alert-success" role="alert">Your comment is awaiting approval.</div>';
                            }

                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                            $result = mysqli_query($connection, $query);
                        }
                    }
                ?>

                        <!-- Comments Form -->
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form action="post.php?p_id=<?php echo $post_id ?>#target" method="post" role="form">
                               
                               <?php
                                    if(!isset($_SESSION["user_id"])){      
                                ?>
                                        <label for="comment_author">Name:</label>
                                        <div class="form-group">
                                            <input id="comment_author" type="text" class="form-control" name="comment_author">
                                        </div>
                                        <label for="comment_email">Email:</label>
                                        <div class="form-group">
                                            <input id="comment_email" type="email" class="form-control" name="comment_email">
                                        </div>
                                <?php
                                    }
                                ?>
                                
                                <label for="comment_content">Comment:</label>
                                <div class="form-group">
                                    <textarea id="comment_content" class="form-control" name="comment_content" placeholder="Leave your comment here" rows="3"></textarea>
                                </div>
                                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                        <hr>

                        <!-- Posted Comments -->

                        <!-- Comment -->
                        <?php  
                            $query = "SELECT * from comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                $comment_date = $row["comment_date"];
                                $comment_content = $row["comment_content"];
                                $comment_author = $row["comment_author"];
                            ?>
                                <div class="media">

                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                        <small><?php echo $comment_date; ?></small>
                                    </h4>
                                    <?php echo $comment_content; ?>
                                </div>
                            </div>
                        <?php
                            } // END WHILE LOOP
                        ?>
                
                <?php   } ?> <!--End If Statement-->

        </div>


    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
