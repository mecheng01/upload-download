<?php

// Database connection parameters
include("db_config/config.php");


if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("SELECT filename FROM files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filename);
    $stmt->fetch();
    $stmt->close();

    if ($filename) {
        $filepath = 'uploads/' . $filename;

        if (file_exists($filepath)) {
            unlink($filepath);
            $stmt = $conn->prepare("DELETE FROM files WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
              //  echo "File deleted successfully.";
                header("Location: index.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "File not found.";
        }
    } else {
        echo "Invalid file ID.";
    }
}

$conn->close();
?>