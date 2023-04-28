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



$sql = "INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) 
		VALUES ('1', '2023-03-27 15:37:03', '2023-03-27 15:37:03', '$post_content', '$post_title', '$post_content', 'publish', 'closed', 'closed', '', '$post_name', '', '', '2023-03-27 15:37:03', '2023-03-27 15:37:03', '', '0', '', '0', 'book', '', '0')";

if (mysqli_query($conn, $sql)) {
  $postid = mysqli_insert_id($conn);

  $query = "INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count)
          VALUES ('1', '2023-03-27 15:37:03', '2023-03-27 15:37:03', '$post_content', '$post_title', '$post_content', 'inherit', 'open', 'closed', '', '$post_name', '', '', '2023-03-27 15:37:03', '2023-03-27 15:37:03', '', '$postid', '$filePath', '0', 'attachment', 'image/jpeg', '0')";

  $result = mysqli_query($conn, $query);
  $postidtwo = mysqli_insert_id($conn);

  if ($result) {
    // echo "Post inserted successfully. Post ID: " . $postidtwo;
  } else {
    echo "Error inserting post: " . mysqli_error($conn);
  }

  $postmetadata = array(
    array('post_id' => $postid, 'meta_key' => '_edit_last', 'meta_value' => '1'),
    array('post_id' => $postid, 'meta_key' => '_edit_lock', 'meta_value' => ''),
    array('post_id' => $postid, 'meta_key' => '_thumbnail_id', 'meta_value' => $postidtwo),
    array('post_id' => $postid, 'meta_key' => 'author', 'meta_value' => $post_author),
    array('post_id' => $postid, 'meta_key' => 'publisher', 'meta_value' => $post_publisher),
    array('post_id' => $postid, 'meta_key' => 'year_of_publication', 'meta_value' => $post_publish_year)
  );

  foreach ($postmetadata as $metadata) {
    $query = "INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('{$metadata['post_id']}', '{$metadata['meta_key']}', '{$metadata['meta_value']}')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      // echo "Post-meta inserted successfully.";
    } else {
      echo "Error inserting post: " . mysqli_error($conn);
    }
  }

  $postmetafile = array(
    array('post_id' => $postidtwo, 'meta_key' => '_wp_attached_file', 'meta_value' => '2023/03/' . $Filename),
    array('post_id' => $postidtwo, 'meta_key' => '_wp_attachment_metadata', 'meta_value' => 'a:6:{s:5:"width";i:240;s:6:"height";i:320;s:4:"file";s:22:"' . $Filename . '";s:8:"filesize";i:73388;s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"1";s:8:"keywords";a:0:{}}}')
  );

  foreach ($postmetafile as $metafile) {
    $query = "INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('{$metafile['post_id']}', '{$metafile['meta_key']}', '{$metafile['meta_value']}')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      // echo "Post-meta2 inserted successfully";
    } else {
      echo "Error inserting post: " . mysqli_error($conn);
    }
  }

  $query = "INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('{$postid}', '{$post_category}', '0')";
  $result = mysqli_query($conn, $query);
  if ($result) {
    // echo "wp_term_relationships inserted successfully";
  } else {
    echo "Error inserting post: " . mysqli_error($conn);
  }

  // echo "save successfully";
  header("location:../home.php?info=saved");

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
