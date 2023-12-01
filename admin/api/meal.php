<?php

include '../connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// API endpoint to get meal data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you pass restaurant_id as a parameter
    $restaurantId = $_GET['restaurant_id'];

    // Query to get meal data for a specific restaurant
    $sql = "SELECT * FROM tbl_meal WHERE restaurant_id = $restaurantId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $meals = array();

        // Fetch data from the result set
        while ($row = $result->fetch_assoc()) {
            $meals[] = $row;
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($meals);
    } else {
        // Return empty JSON array if no meals found
        header('Content-Type: application/json');
        echo json_encode([]);
    }
}

$conn->close();

?>
