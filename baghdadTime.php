<?php

// Capture the current time (file upload time)
$DateTimeuploaded = $row['upload_date'];
$uploadTime = new DateTime($DateTimeuploaded, new DateTimeZone("UTC"));

// Define the timezones you want to convert to
$timezones = [
    'Asia/Baghdad'

];

// Display the original upload time in UTC
// echo "Original Upload Time (UTC): " . $uploadTime->format('Y-m-d H:i A') . " UTC\n";

// Convert and display the upload time in the defined timezones
foreach ($timezones as $timezone) {
    $uploadTime->setTimezone(new DateTimeZone($timezone));

    //echo "Upload Time in $timezone: " . $uploadTime->format('Y-m-d | H:i A') . "\n";
    echo  $uploadTime->format('Y-m-d | g:i A') . "\n";
}


//$currentDateTime = $row['upload_date'] ;
// echo $newDateTime = date('Y-m-d | h ++ 3:i A', strtotime($currentDateTime));