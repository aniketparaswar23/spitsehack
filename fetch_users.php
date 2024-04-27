<?php
// Connect to the database (Replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the database for users with the role "farmer"
$sql = "SELECT * FROM users WHERE role='farmer'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="frame">';
        // Exclude profile picture for farmers
        echo '<h2>' . $row["location"] . '</h2>';
        echo '<p>Email: ' . $row["email"] . '</p>';
        echo '<p>Full Name: ' . $row["name"] . '</p>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
