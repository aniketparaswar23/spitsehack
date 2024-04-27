<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crops";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $category = $_POST['category'];
    $item = $_POST['items'];
    $harvest_date = $_POST['harvest_date'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $coupon = $_POST['coupon'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    // SQL INSERT query
    $sql = "INSERT INTO crops_data (category, item, harvest_date, quantity, price, coupon, discount, description)
            VALUES ('$category', '$item', '$harvest_date', $quantity, $price, '$coupon', $discount, '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "CROPS ADDED SUCCESSFULLY";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
