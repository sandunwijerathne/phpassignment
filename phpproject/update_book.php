<?php
require('db.php');
include("auth.php");

if (isset($_GET['ID'])) {
	$id = $_GET['ID'];
} else {
	header("location:home.php?info=add_book");
}
// echo $id;

$all = "SELECT * FROM `wp_posts` WHERE post_status = 'publish' AND post_type = 'book' AND ID = $id";
$all_query = mysqli_query($conn, $all);
if (mysqli_num_rows($all_query) > 0) {
	while ($row = mysqli_fetch_assoc($all_query)) {
		$ID = $row['ID'];
		$post_title = $row['post_title'];
		$post_content = $row['post_content'];
	}
} else {
	echo "no data";
}

$all = "SELECT * FROM `wp_posts` WHERE post_parent =$id";
$all_query = mysqli_query($conn, $all);
if (mysqli_num_rows($all_query) > 0) {
	while ($row = mysqli_fetch_assoc($all_query)) {
		$imagepath = $row['guid'];
	}
} else {
	echo "no data";
}

$all = "SELECT * FROM wp_postmeta WHERE post_id =$id AND meta_key= 'author'";
$all_query = mysqli_query($conn, $all);
if (!$all_query) {
	die('Query failed: ' . mysqli_error($conn));
}
if (mysqli_num_rows($all_query) > 0) {
	$row = mysqli_fetch_assoc($all_query);
	$getpostauthor = $row['meta_value'];
} else {
	echo "no data";
}

$all = "SELECT * FROM wp_postmeta WHERE post_id =$id AND meta_key = 'publisher'";
$all_query = mysqli_query($conn, $all);
if (!$all_query) {
	die('Query failed: ' . mysqli_error($conn));
}
if (mysqli_num_rows($all_query) > 0) {
	$row = mysqli_fetch_assoc($all_query);
	$getpostpublisher = $row['meta_value'];
} else {
	echo "no data";
}

$all = "SELECT * FROM wp_postmeta WHERE post_id =$id AND meta_key = 'year_of_publication'";
$all_query = mysqli_query($conn, $all);
if (!$all_query) {
	die('Query failed: ' . mysqli_error($conn));
}
if (mysqli_num_rows($all_query) > 0) {
	while ($row = mysqli_fetch_assoc($all_query)) {
		$getpostyear = $row['meta_value'];
	}
} else {
	echo "no data";
}

$all = "SELECT * FROM wp_term_relationships WHERE object_id = $id";
$all_query = mysqli_query($conn, $all);
if (!$all_query) {
	die('Query failed: ' . mysqli_error($conn));
}
if (mysqli_num_rows($all_query) > 0) {
	$row = mysqli_fetch_assoc($all_query);
	$term_taxonomy_id = $row['term_taxonomy_id'];
} else {
	echo "no data";
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
						<a class="nav-link text-light" href="home.php">
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
			<form method="POST" action="process/bookupdate.php" enctype="multipart/form-data">

				<div class="row">
					<div class="col-sm-6">
						<label for="post_title">Book Title</label>
						<input type="text" required class="form-control" name="post_id" id="post_title" aria-describedby="post_title" hidden value="<?php echo $id; ?>">
						<input type="text" required class="form-control" name="post_title" id="post_title" aria-describedby="post_title" value="<?php echo $post_title; ?>">
					</div>
					<div class="col-sm-6">
						<label for="post_title">Book Image</label>
						<input type="file" required class="form-control" name="post_image" id="post_image" aria-describedby="post_title" value="">

					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="post_title">Book Author</label>
						<input type="text" required class="form-control" name="post_author" id="post_title" aria-describedby="post_title" value="<?php echo $getpostauthor; ?>">
					</div>

					<div class="col-sm-6">
						<label for="post_title">Publisher</label>
						<input type="text" required class="form-control" name="post_publisher" id="post_title" aria-describedby="post_title" value="<?php echo $getpostpublisher; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="post_title">Book Publication Year</label>
						<input type="text" required class="form-control" name="post_year_of_publication" id="post_title" aria-describedby="post_title" value=" <?php echo $getpostyear; ?>">
					</div>
					<div class="col-sm-6">
						<label for="post_title">Book Category</label>
						<select name="post_categories" class="form-control" id="post_categories">
							<?php
							$all = "SELECT * FROM wp_terms";
							$all_query = mysqli_query($conn, $all);
							if (mysqli_num_rows($all_query) > 0) {
								while ($row = mysqli_fetch_assoc($all_query)) {
									$getpostyear = $row['term_id'];
									if ($row['term_id'] == $term_taxonomy_id) {
							?>
										<option value="<?php echo $row['term_id']; ?>" selected><?php echo $row['name']; ?></option>
									<?php
									} else {
									?>
										<option value="<?php echo $row['term_id']; ?>"><?php echo $row['name']; ?></option>
									<?php
									}
									?>
							<?php
								}
							} else {
								echo "no data";
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">

					<div class="col-sm-6">
						<label for="post_content">Post Content</label>
						<textarea type="text" required name="post_content" class="form-control" id="post_content" rows="5" cols="500"><?php echo $post_content; ?></textarea>
					</div>
					<div class="col-sm-6">
						<img src="<?Php echo $imagepath; ?>" width="100" style="margin-top: 32px;">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<button id="submit_post" type="submit" class="btn btn-primary">Update Book</button>
					</div>
				</div>
			</form>
		</div>
</body>

</html>