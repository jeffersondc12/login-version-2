<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videodb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$title = $_POST['title'];
$description = $_POST['description'];
$video = $_FILES['video']['name'];
$target_dir = "uploads";
$target_file = $target_dir . basename($video);

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES['video']['tmp_name'], $target_file)) {
    // Insert video details into database
    $sql = "INSERT INTO videos (title, description, file_path) VALUES ('$title', '$description', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "The video has been uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Close connection
$conn->close();
?>
