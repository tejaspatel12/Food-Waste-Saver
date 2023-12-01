<?php

header("Content-Type: application/json");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($json_data, true);

    // Check if the required data is present
    if (isset($data['restaurant_id'], $data['meals'], $data['order_total'])) {
        // Extract data
        $restaurant_id = $data['restaurant_id'];
        $meals = $data['meals'];
        $order_total = $data['order_total'];

        // Include your database connection file
        include '../connection.php';

        // Insert order data into tbl_order
        $order_date = date('Y-m-d');
        $order_hour = date('H:i:s');

        $stmt = $conn->prepare("INSERT INTO tbl_order (restaurant_id, member_id, order_date, order_hour, order_total) VALUES (?, 1, ?, ?, ?)");
        $stmt->bind_param('issd', $restaurant_id, $order_date, $order_hour, $order_total);
        $stmt->execute();

        // Get the order ID
        $order_id = $conn->insert_id;

        // Insert order details into tbl_order_detail
        foreach ($meals as $mealGroup) {
            foreach ($mealGroup as $meal) {
                $meal_id = $meal['id'];
                $quantity = $meal['quantity'];
                $price = $meal['discount_price'];
        
                // Insert order detail
                $stmt1 = $conn->prepare("INSERT INTO tbl_order_detail (order_id, meal_id, od_quantity, od_price) VALUES (?, ?, ?, ?)");
                $stmt1->bind_param('iiid', $order_id, $meal_id, $quantity, $price);
                $stmt1->execute();
            }
        }

        // Commit the transaction
        $conn->commit();

        // Send a success response
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Invalid data provided']);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}

?>
