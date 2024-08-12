<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {

            $response['status'] = 'exists';
            $response['message'] = 'Sorry, the file already exists!';
            //echo 'Sorry, the file already exists';
            $uploadOk = 0;
        } else {

            // Check if the file is allowed (you can modify this to allow specific file types)
            $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf", "nwd", "zip");
            if (!in_array($file_type, $allowed_types)) {
                $response = ['status' => 'fileType', 'message' => 'Sorry, only JPG, JPEG, PNG, GIF, PDF, nwd and zip files are allowed.'];
                // echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, nwd and zip files are allowed.";
            } else {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // File upload success, now store information in the database
                    $filename = $_FILES["file"]["name"];
                    $filesize = $_FILES["file"]["size"];
                    $filetype = $_FILES["file"]["type"];

                    // Database connection

                    include("db_config/config.php");

                    // Insert the file information into the database
                    $sql = "INSERT INTO files (filename, filesize, filetype) VALUES ('$filename', $filesize, '$filetype')";

                    if ($conn->query($sql) === TRUE) {
                        // echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and the information has been stored in the database.";
                        $response = ['status' => 'success', 'message' => 'File uploaded successfully!'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Database error: ' . $stmt->error];
                        // echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                    }

                    $conn->close();
                } else {
                    $response = ['status' => 'error', 'message' => 'Error moving the uploaded file.'];
                    // echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo '<div id = "NofileUploaded"></div>';
    }
}
echo json_encode($response);
