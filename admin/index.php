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
                            Welcome to the admin
                            <small><?php echo $_SESSION["username"] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php
                    // COUNT NUMBER OF POSTS
                    $query = "SELECT * FROM posts";
                    $result = mysqli_query($connection, $query);
                    $post_count = mysqli_num_rows($result);

                    // COUNT NUMBER OF COMMENTS
                    $query = "SELECT * FROM comments";
                    $result = mysqli_query($connection, $query);
                    $comment_count = mysqli_num_rows($result);

                    // COUNT NUMBER OF USERS
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection, $query);
                    $user_count = mysqli_num_rows($result);

                    // COUNT NUMBER OF CATEGORIES
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query);
                    $category_count = mysqli_num_rows($result);
                ?>
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge'><?php echo $post_count ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $comment_count ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_count ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $category_count ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php
                    // COUNT NUMBER OF DRAFT POSTS
                    $query = "SELECT * FROM posts WHERE post_status = 'Draft'";    
                    $result = mysqli_query($connection, $query);
                    $draft_post_count = mysqli_num_rows($result);        

                    // COUNT NUMBER OF PUBLISHED POSTS
                    $query = "SELECT * FROM posts WHERE post_status = 'Published'";    
                    $result = mysqli_query($connection, $query);
                    $published_post_count = mysqli_num_rows($result);

                    // COUNT NUMBER OF UNAPPROVED COMMENTS
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";    
                    $result = mysqli_query($connection, $query);
                    $unapproved_comment_count = mysqli_num_rows($result);

                    // COUNT NUMBER OF SUBSCRIBERS
                    $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";    
                    $result = mysqli_query($connection, $query);
                    $subscriber_count = mysqli_num_rows($result);
                ?>
                
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],
                                
                                <?php
                                    $element_text = ["Published Posts", "Draft Posts", "Comments", "Pending Comments", "Users", "Subscribers", "Categories"];
                                    $element_values = [$published_post_count, $draft_post_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_count, $category_count];

                                    for($i = 0; $i < count($element_text); $i++){
                                        echo "['{$element_text[$i]}'" . "," . "{$element_values[$i]}],";
                                    }
                                ?>
                                
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php" ?>