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

// Fetch videos from database
$sql = "SELECT title, description, file_path FROM videos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<video width='320' height='240' controls>
                <source src='" . $row['file_path'] . "' type='video/mp4'>
                Your browser does not support the video tag.
              </video>";
        echo "</div><br>";
    }
} else {
    echo "No videos found.";
}

// Close connection
$conn->close();
?>
