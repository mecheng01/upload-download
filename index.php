<?php include("db_config/config.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <html lang="en" data-bs-theme="dark">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assest/css/all.min.css">
    <link rel="stylesheet" href="assest/css/styles.css">
    <title>File upload and download</title>
    <style>
    #progressBarContainer {
        display: none;
    }

    .extendTitel {
        margin-top: 100px;

    }
    </style>
</head>

<body>
    <!-- form upload -->
    <div class="container-sm bg-dark fixed-top pt-3 ">
        <h3>Upload File</h3>
        <!-- Alert Box -->
        <div id="alertBox" class="alert d-none" role="alert"></div>
        <!-- Upload Form -->
        <form class="" id="uploadForm" enctype="multipart/form-data">
            <div class="input-group">
                <input type="file" class="form-control" id="fileInput" name="file" required>
                <button class="btn btn-danger" type="button" onclick="clearFileInput()"><i
                        class="fa-regular fa-trash-can"></i>
                    Clear</button>
                <button class="btn btn-success" type="submit"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                    Upload</button>
            </div>
        </form>

        <!-- Progress Bar -->
        <div id="progressBarContainer" class="mt-3">
            <div class="progress">
                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
    </div>
    <!--Files uploaded-->
    <div class="extendTitel" id="fileLists">
        <!-- File list will be inserted here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPsjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="assest/js/all.min.js"></script>
    <script src="assest/js/backend.js"></script>
    <script src="assest/js/delete.js"></script>
</body>

</html>