<div class="col-md-4">

  <!-- Blog Search Well -->
  <div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
      <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
      </div>
    </form>
    <!--Search Form-->
    <!-- /.input-group -->
  </div>

  <!-- Login -->
  <?php
    if(!isset($_SESSION["user_role"])){ ?>
      <div class="well">
      <h4>Login</h4>
      <form action="includes/login.php" method="post">
        <div class="form-group">
          <input name="username" type="text" class="form-control" placeholder="Username:">
        </div>
        <div class="form-group">
          <input name="password" type="password" class="form-control" placeholder="Password:">
        </div>
        <div class="form-group">
          <button class="btn btn-primary form-control" name="login" type="submit">Login</button>
        </div>
      </form>
      <!--Search Form-->
      <!-- /.input-group -->
    </div>
    <?php } ?>
  

    <!-- Blog Categories Well -->
    <div class="well">
      <h4>Blog Categories</h4>
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled">

            <?php
                
                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($result)){
                            $cat_title = $row["cat_title"];
                            $cat_id = $row["cat_id"];

                            echo "<li><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                        }
                
                    ?>
          </ul>
        </div>
      </div>
      <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>
