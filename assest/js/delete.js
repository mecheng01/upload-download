//Handling deletion of files
function confirmDeletion(event) {
    // Show confirmation dialog
    if (!confirm("Are you sure you want to delete this item?")) {
        // Prevent form submission if user cancels
        event.preventDefault();
    }
}

//Handling clear input
function clearFileInput() {
    document.getElementById('fileInput').value = '';
}
