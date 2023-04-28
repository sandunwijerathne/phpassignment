<?php
  if (isset($_REQUEST['info'])) {

$mem_id = $_REQUEST['info'];
if ($_REQUEST['info'] == "error") {
  echo "<div class='alert alert-warning'><b>Username Or Password Is worng Please Check and Try Again</b></div>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Management</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <style type="text/css">
    .background{
      position: fixed;
      z-index: -1000;
      width: 100%;
      height: 100%;
      overflow: hidden;
      top: 0;
      left: 0;
    }
	.form{
		width:30%;
		margin-left:35%;
		margin-top:7%;
	}
	
	hr{
		background-color:white;
	}
    .navbar{
      background-color: transparent !important;
    }
  </style>
</head>
<body>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">

<div class="container-fluid">
  <a class="navbar-brand" href="index.php"><h3>BOOK MANAGEMENT SYSTEM</h3></a>
 
</div>
</nav>
<hr>
 <h2 style="color:white; text-align:center;"> Access Only To Admin</h2>
 <hr>

<form class="form " action="process/login_process.php" method="post">
	  <input type="text" class="form-control mb-2 mr-sm-2" name="username" placeholder="USERNAME" required> <br/>
	  <input type="password" class="form-control mb-2 mr-sm-2" name="pwd" placeholder="PASSWORD" required> <br/>
	  <button type="submit" class="btn btn-outline-light mb-2" name="login_user">Login</button>
</form>

<div class="background">
  <img src="images/darkbackground.jpg">
</div>

</body>
</html>