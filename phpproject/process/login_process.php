<?php
session_start();
require('../db.php');
$username = "";
$errors = array();

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  if (count($errors) == 0) {
    $query = "SELECT * FROM wp_users WHERE user_email='$username'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['uname'] = $username;
      $row = $results->fetch_assoc();

      $password_hashed = $row['user_pass'];  
      $pwd = md5($pwd);

      if ($pwd == $password_hashed) {
        header("location:../home.php?info=add_book");
      } else {
        header("Location: ../index.php?info=error");
      }
      die();

    } else {
      header("Location: ../index.php?info=error");
    }
  }
}
