//Work Clearly
$(document).ready(function () {
    // Function to fetch and display the list of files
    function fetchFiles() {
        $.ajax({
            url: 'download.php',
            method: 'GET',
            success: function (data) {
                $('#fileLists').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                updateAlert('danger', 'Failed to fetch file list! ' + textStatus + ': ' + errorThrown);
            }
        });
    }

    // Fetch files on page load
    fetchFiles();

    // Handle file upload form submission
    $('#uploadForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        // Show the progress bar container
        $('#progressBarContainer').show();

        $.ajax({
            xhr: function () {
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        var percentComplete = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').width(percentComplete + '%').text(percentComplete + '%');

                        // Show alert when file upload starts
                        updateAlert('info', 'File is uploading...');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'upload.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Parse the response to JSON
                try {
                    response = JSON.parse(response);

                    // Hide the progress bar container
                    $('#progressBarContainer').hide();

                    // Update the alert based on response status
                    if (response.status === 'success') {
                        updateAlert('success', response.message);
                    } else if (response.status === 'fileType' || response.status === 'exists') {
                        updateAlert('warning', response.message);
                    } else {
                        updateAlert('danger', 'Unexpected response from server');
                    }

                    // Fetch and display the updated file list
                    fetchFiles();
                } catch (error) {
                    updateAlert('danger', 'Invalid server response.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the progress bar container
                $('#progressBarContainer').hide();

                // Show error alert
                updateAlert('danger', 'File upload failed! ' + textStatus + ': ' + errorThrown);
            }
        });
    });

    // Function to update the alert box
    function updateAlert(type, message) {
        var alertBox = $('#alertBox');

        // Reset alert classes and message
        alertBox.removeClass('alert-info alert-success alert-danger alert-warning')
            .addClass('alert-' + type)
            .text(message)
            .removeClass('d-none')
            .stop(true, true).fadeIn().delay(3000).fadeOut(function () {
                $(this).addClass('d-none').removeAttr('style');
            });
    }
});
