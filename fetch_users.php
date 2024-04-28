<?php
$item1 = $_GET['data'];
// Connect to the databases (Replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname1 = "signup_db"; // First database
$dbname2 = "crops"; // Second database

// Create connection to the first database
$conn1 = new mysqli($servername, $username, $password, $dbname1);

// Check connection to the first database
if ($conn1->connect_error) {
    die("Connection to database1 failed: " . $conn1->connect_error);
}

// Create connection to the second database
$conn2 = new mysqli($servername, $username, $password, $dbname2);

// Check connection to the second database
if ($conn2->connect_error) {
    die("Connection to database2 failed: " . $conn2->connect_error);
}

// Prepare the SQL query with a placeholder for the item name
$sql = "SELECT *
FROM crops.crops_data AS cd
JOIN signup_db.users AS u ON cd.sessionId = u.mobile
WHERE cd.item ='$item1'";


$result = $conn2->query($sql);

// Output data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output data
        echo "Category: " . $row["category"] . "<br>";
        echo "Item: " . $row["item"] . "<br>";
        echo "Harvest Date: " . $row["harvest_date"] . "<br>";
        echo "Price: " . $row["price"] . "<br>";
        echo "Coupon: " . $row["coupon"] . "<br>";
        echo "Discount: " . $row["discount"] . "<br>";
        echo "Description: " . $row["description"] . "<br>";
        // Output user data (if needed)
        echo "User ID: " . $row["id"] . "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        // Add more user data fields as needed
        echo "<br>";
    }
} else {
    echo "No results found.";
}

// Close the statement and connection

$conn1->close();
$conn2->close();
?>