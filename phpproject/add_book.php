<?php
include("auth.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Book Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="style.css">
</head>

<body style="background:url(images/darkbackground.jpg);">
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">BOOK MANAGEMENT SYSTEM</a>
      <a href="logout.php" class=" nav nav-link">log out</a>
    </div>
  </nav>
  <div class="row mt-3">
    <div class="col-2">
      <div id="accordion">
        <div class="list-group">
          <div class="list-group-item bg-dark">
            <a class="nav-link text-light" href="home.php">
              <i class="fas fa-book"></i> All BOOK</a>
          </div>
          <div class="list-group-item bg-dark">
            <a class=" nav-link text-light" href="#">
              <i class="fas fa-book"></i> Add BOOK</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-10">
      <form method="POST" action="process/cretepost.php" enctype="multipart/form-data">

        <div class="row">
          <div class="col-sm-6">
            <label for="post_title">Book Title</label>
            <input type="text" required class="form-control" name="post_title" id="post_title" aria-describedby="post_title">
          </div>
          <div class="col-sm-6">
            <label for="post_title">Book Image</label>
            <input type="file" required class="form-control" name="post_image" id="post_image" aria-describedby="post_title">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <label for="post_title">Book Author</label>
            <input type="text" required class="form-control" name="post_author" id="post_title" aria-describedby="post_title">
          </div>

          <div class="col-sm-6">
            <label for="post_title">Publisher</label>
            <input type="text" required class="form-control" name="post_publisher" id="post_title" aria-describedby="post_title">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <label for="post_title">Book Publication Year</label>
            <input type="text" required class="form-control" name="post_year_of_publication" id="post_title" aria-describedby="post_title">
          </div>
          <div class="col-sm-6">
            <label for="post_title">Book Category</label>
            <select name="post_categories" class="form-control" id="post_categories">
              <?php
              require('db.php');


              $all = "SELECT * FROM `wp_terms`";
              $all_query = mysqli_query($conn, $all);
              if (mysqli_num_rows($all_query) > 0) {
                while ($row = mysqli_fetch_assoc($all_query)) {;
              ?>
                  <option value="<?php echo $row['term_id']; ?>"><?php echo $row['name']; ?></option>
              <?php
                }
              } else {
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="post_content">Post Content</label>
            <textarea type="text" required name="post_content" class="form-control" id="post_content" rows="5" cols="500"></textarea>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <button id="submit_post" type="submit" class="btn btn-primary">Publish Book</button>
          </div>
        </div>
      </form>
    </div>
</body>

</html>