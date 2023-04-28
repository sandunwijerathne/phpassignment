<?php

require('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $post_ID = $_GET['ID'];
}
$deleteQuery = "DELETE FROM wp_posts WHERE ID = $post_ID";

// Execute the delete query
if (mysqli_query($conn, $deleteQuery)) {
    // Deletion successful
    return header("Location: ../home.php?info=deleted");
} else {
    // Deletion failed
    echo "Error deleting post: " . mysqli_error($conn);
}