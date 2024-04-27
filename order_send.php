<?php
session_start();
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
    $sessionId = $_SESSION['user_details'];
    

    // SQL INSERT query
    $sql = "INSERT INTO crops_data (category, item, harvest_date, quantity, price, coupon, discount, description,sessionId)
            VALUES ('$category', '$item', '$harvest_date', $quantity, $price, '$coupon', $discount, '$description','$sessionId')";

    if ($conn->query($sql) === TRUE) {
        echo "<style>
    .success-alert-box {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
        padding: 15px;
        margin: 20px auto;
        width: 50%;
        text-align: center;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .success-alert-box h2 {
        margin-top: 0;
    }
</style>";
echo "<div class='success-alert-box'>
    <h2>New record inserted successfully</h2>
    <p>Please wait while you are being redirected...</p>
</div>";
echo "<script>
    setTimeout(function() {
        window.location.href = 'orders.html';
    }, 3000); // Redirect after 3 seconds
</script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
