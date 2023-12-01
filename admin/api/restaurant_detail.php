<?php

include '../connection.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['restaurantId'])) {
        $restaurantId = $_GET['restaurantId'];

        // Prepare and execute a SQL query to fetch restaurant details
        $stmt = $conn->prepare("SELECT * from tbl_restaurant WHERE restaurant_id = ?");
        $stmt->bind_param("i", $restaurantId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the result as an associative array
        $restaurant = $result->fetch_assoc();

        // If the restaurant is found, return its details; otherwise, return an empty array
        if ($restaurant) {
            header('Content-Type: application/json');
            echo json_encode($restaurant);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Restaurant not found']);
        }

        // Close the database connection
        $stmt->close();
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing restaurantId parameter']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>
