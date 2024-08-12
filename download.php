<?php
include("db_config/config.php");

//Fetch the uploaded files from the database

$sql = "SELECT *FROM files";
$result = $conn->query($sql);

?>

<div class="container mt-5">
    <h3 class="mt-4">Available Files</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>File Name</th>
                <th>File Size</th>
                <th>File Type</th>
                <th>Uploaded Date</th>
                <th>Download & Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display the uploaded files and download links
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file_path = "uploads/" . $row['filename'];
                    $id = $row['id'];





            ?>
            <tr>
                <td><?php echo $row['filename']; ?></td>
                <td><?php echo number_format($row['filesize'] / 1048576, 2); ?> Mb</td>
                <td><?php echo $row['filetype']; ?></td>
                <td>
                    <p class="text-success"><?php

                                                    include 'baghdadTime.php';
                                                    ?> </p>
                </td>
                <td>

                    <div class="d-flex justify-content-around">
                        <!-- Dolwaload code-->
                        <div>
                            <!--<a href="" download><i
                                    class="fa-solid fa-circle-down fa-2xl"></i></a>
                                <form method="post" action="delete.php" style="display: inline-block">
                                    <input type="hidden" name="id" value="" />
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fa-solid fa-trash-can fa-sm"></i> Download</button>
                                </form>-->
                            <a class="btn btn-outline-success" href="<?php echo $file_path; ?>" download><i
                                    class="fa-regular fa-circle-down fa-xl"></i> Download</a>
                        </div>

                        <!-- Delete code-->
                        <div>
                            <!--  <a data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class="fa-solid fa-trash-can fa-2xl" style="cursor: pointer; color: #f00000;"></i>
                            </a>-->
                            <!-- Your Delete Form -->
                            <form method="post" action="delete.php" style="display: inline-block"
                                onsubmit="confirmDeletion(event)">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <button type="submit" class="btn btn-outline-danger"><i
                                        class="fa-solid fa-trash-can fa-xl"></i> Delete</button>
                            </form>

                        </div>
                    </div>
                </td>
            </tr>
</div>
<?php
                }
            } else {
?>
<tr>
    <td colspan=" 5">No files uploaded yet.
    </td>
</tr>
<?php
            }
?>
</tbody>
</table>
</div>

<?php
$conn->close();
?>