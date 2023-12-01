<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;

    // Check if the required data is present
    if (
        isset($data['city_name'])
    ) {
        // Extract data
        $city_name = $data['city_name'];

        include '../connection.php';

        try {
            // Insert restaurant data into tbl_restaurant
            $stmt = $conn->prepare("INSERT INTO tbl_city (city_name) VALUES (?)");
            $stmt->bind_param('ssssssidds', $city_name);
            $stmt->execute();

            // Send a success response
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            // Handle database error
            echo json_encode(['error' => 'Error adding restaurant: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid data provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>