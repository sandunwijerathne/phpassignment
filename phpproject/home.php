<?php
include("auth.php");
if (isset($_REQUEST['info'])) {

  $mem_id = $_REQUEST['info'];
  if ($_REQUEST['info'] == "saved") {
    echo "<div class='alert alert-success'><b>New Book Details Added</b></div>";
  }elseif ($_REQUEST['info'] == "updated") {
    echo "<div class='alert alert-success'><b>Book Details Updated</b></div>";
  }elseif ($_REQUEST['info'] == "deleted") {
    echo "<div class='alert alert-success'><b>Book Deleted Sucsesfull</b></div>";
  }elseif ($_REQUEST['info'] == "saved") {
    echo "<div class='alert alert-success'><b>New Book Details Added</b></div>";
  }
}
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
            <a class="nav-link text-light" href="#">
              <i class="fas fa-book"></i> All BOOK</a>
          </div>
          <div class="list-group-item bg-dark">
            <a class=" nav-link text-light" href="add_book.php">
              <i class="fas fa-book"></i> Add BOOK</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-10">
      <h4 class="text-muted text-light">List Of Books</h4>

      <table class="table table-bordered">
        <thead class="thead-dark ">
          <tr>
            <th scope="col" colspan="4">Book Name</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require('db.php');


          $all = "SELECT * FROM `wp_posts` WHERE post_status = 'publish' AND post_type = 'book'";
          $all_query = mysqli_query($conn, $all);
          if (mysqli_num_rows($all_query) > 0) {
            while ($row = mysqli_fetch_assoc($all_query)) {


          ?>
              <tr>
                <td colspan="4" class='text-light'><?php echo $row['post_title']; ?></td>
                <td class="center"><a href="update_book.php?ID=<?php echo $row['ID']; ?>" class="badge badge-warning badge-pill">Update</a></td>
                <td class="center"><a href="process/delete_book.php?ID=<?php echo $row['ID']; ?>" class="badge badge-danger badge-pill">Delete</a></td>
              </tr>
            <?php
            }
          } else {
            ?>
            <tr>
              <td colspan="6">No data</td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>

    </div>
  </div>

</body>

</html>