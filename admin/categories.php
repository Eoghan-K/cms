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
                        <div class="col-xs-6">
                            <form action="categories.php" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category:</label>
                                    <input id="cat-title" class="form-control" type="text" name="cat_title" required>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                            <?php createCategory(); ?> <!--CREATE CATEGORY-->
                            <?php /*UPDATE CATEGORY*/
                                if(isset($_GET["update"])){
                                    $cat_id = $_GET["update"];
                                    include "includes/update_categories.php";
                                }
                            ?>
                        </div>
                        <div class="col-xs-6">   
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php // SHOW CATEGORIES
                                        showAllCategories();
                                    ?>
                                </tbody>
                            </table>
                            <?php // DELETE QUERY
                                deleteCategory();
                            ?>
                        </div>
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