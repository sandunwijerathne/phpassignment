<?php

require('../db.php');
class fillesave
{
    function uploadFile($file)
    {
        // Check if file was uploaded without errors
        if (isset($file) && $file['error'] == 0) {
            $filename = $file['name'];
            $filename = str_replace(array(" ", "(", ")"), "", $filename);
            $tempFilePath = $file['tmp_name'];
            $filePath = '../../swivel/wp-content/uploads/2023/03/' . $filename;
            // Move uploaded file to desired location
            if (move_uploaded_file($tempFilePath, $filePath)) {
                $filePath = str_replace("../../", "http://localhost/", $filePath);
                // Return file path with filename
                return $filePath;
            } else {
                // Return error message if file upload failed
                return "File upload failed. Please try again.";
            }
        } else {
            // Return error message if file upload failed
            return "File upload failed. Please try again.";
        }
    }
}
