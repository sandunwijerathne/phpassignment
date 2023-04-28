<?php
http_response_code(404);
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

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">Oops! That page can&rsquo;t be found.', 'your-theme-text-domain</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>


				</div>
			</section>

		</div>
	</div>

</body>

</html>