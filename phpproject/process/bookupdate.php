<?php

require('../db.php');
require('filesave.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_title = $_POST['post_title'];
    $post_image = $_FILES['post_image'];
    $post_content = $_POST['post_content'];
    $post_author = $_POST['post_author'];
    $post_publisher = $_POST['post_publisher'];
    $post_publish_year = $_POST['post_year_of_publication'];
    $post_category = $_POST['post_categories'];
}
$Filename = $post_image['name'];
$Filename = str_replace(array(" ", "(", ")"), "", $Filename);

$post_name = str_replace(" ", "", $post_title);
$filePathcc = new fillesave();
$filePath = $filePathcc->uploadFile($post_image);

$post_id = $_POST['post_id'];
$sql = "UPDATE wp_posts SET post_title = '$post_title', post_content = '$post_content', post_excerpt = '$post_content', post_name = '$post_title' WHERE ID = $post_id";
$result = mysqli_query($conn, $sql);
if ($result) {
    // echo "wp_term_relationships inserted successfully";

    // Create postmeta for post image
    $sql = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES ($post_id, '_wp_attached_file', '2023/03/$Filename')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "wp_term_relationships inserted successfully";
    } else {
        echo "Error inserting post: " . mysqli_error($conn);
    }

    // Update postmeta for author
    $sql = "UPDATE wp_postmeta SET meta_value = '$post_author' WHERE post_id = $post_id AND meta_key = 'author'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "wp_term_relationships inserted successfully";
    } else {
        echo "Error inserting post: " . mysqli_error($conn);
    }

    // Update postmeta for publisher
    $sql = "UPDATE wp_postmeta SET meta_value = '$post_publisher' WHERE post_id = $post_id AND meta_key = 'publisher'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "wp_term_relationships inserted successfully";
    } else {
        echo "Error inserting post: " . mysqli_error($conn);
    }

    // Update postmeta for year of publication
    $sql = "UPDATE wp_postmeta SET meta_value = '$post_publish_year' WHERE post_id = $post_id AND meta_key = 'year_of_publication'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "wp_term_relationships inserted successfully";
    } else {
        echo "Error inserting post: " . mysqli_error($conn);
    }

    // Update term relation for category
    $sql = "UPDATE wp_term_relationships SET term_taxonomy_id = $post_category WHERE object_id = $post_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "wp_term_relationships inserted successfully";
    } else {
        echo "Error inserting post: " . mysqli_error($conn);
    }

    header("location:../home.php?info=updated");
} else {
    echo "Error inserting post: " . mysqli_error($conn);
}
