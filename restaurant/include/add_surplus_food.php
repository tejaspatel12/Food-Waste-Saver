<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;

    // Check if the required data is present
    if (
        isset($data['restaurant_id'], $data['meal_id'], $data['quantity'])
    ) {
        // Extract data
        $restaurant_id = $data['restaurant_id'];
        $meal_id = $data['meal_id'];
        $quantity = $data['quantity'];
        $todaydate = date('Y-m-d');

        // Include your database connection file
        include '../../admin/connection.php';

        try {
            // Insert restaurant data into tbl_restaurant
            $stmt = $conn->prepare("INSERT INTO tbl_surplus_meals (restaurant_id, meal_id, surplus_quantity, surplus_total_quantity, surplus_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param($restaurant_id, $meal_id, $quantity, $quantity, $todaydate);
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
