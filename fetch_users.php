<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmers Data</title>
<style>
/* Global styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 20px;
}

/* CSS for farmer frames */
.farmer-frame {
    width: 300px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin: 10px;
    transition: transform 0.3s ease-in-out;
}

.farmer-frame:hover {
    transform: translateY(-5px);
}

/* CSS for farmer details */
.farmer-details {
    padding: 16px;
}

/* CSS for specific data fields */
.category {
    font-weight: bold;
    color: #006600; /* Green color for category */
}

.item {
    color: #0000cc; /* Blue color for item */
}

.price {
    font-weight: bold;
    color: #ff6600; /* Orange color for price */
}

.description {
    margin-top: 8px;
    font-style: italic;
}
</style>
</head>
<body>

<div class="container">
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
            // Start farmer frame
            echo '<div class="farmer-frame">';
            
            // Farmer details
            echo '<div class="farmer-details">';
            echo '<span class="category">Category: </span>' . $row["category"] . "<br>";
            echo '<span class="item">Item: </span>' . $row["item"] . "<br>";
            echo '<span class="price">Price: </span>' . $row["price"] . "<br>";
            echo '<span class="description">Description: </span>' . $row["description"] . "<br>";
            // Output user data (if needed)
            echo 'User ID: ' . $row["id"] . "<br>";
            echo 'Name: ' . $row["name"] . "<br>";
            echo 'Email: ' . $row["email"] . "<br>";
            // Add more user data fields as needed
            echo '</div>'; // End farmer-details

            // End farmer frame
            echo '</div>'; // End farmer-frame
        }
    } else {
        echo "No results found.";
    }

    // Close the statement and connection

    $conn1->close();
    $conn2->close();
    ?>
</div>

</body>
</html>
