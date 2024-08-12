<?php

// Database connection parameters
include("db_config/config.php");

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("SELECT filename FROM files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filename);
    if ($stmt->fetch()) {
        echo $filename;
    }  

    $stmt->close();
} else 
   

$conn->close();