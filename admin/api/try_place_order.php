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

        $conn->autocommit(false);
        try {
            // Start a transaction
            // $conn->beginTransaction();

            // Insert order data into tbl_order
            $order_date = date('Y-m-d');
            $order_hour = date('H:i:s');
            // $order_total = 0; // Calculate the total based on meal prices

            $stmt = $conn->prepare("INSERT INTO tbl_order (restaurant_id, member_id, order_date, order_hour, order_total) VALUES (:restaurant_id, 1, :order_date, :order_hour, :order_total)");
            $stmt->bindParam(':restaurant_id', $restaurant_id);
            $stmt->bindParam(':order_date', $order_date);
            $stmt->bindParam(':order_hour', $order_hour);
            $stmt->bindParam(':order_total', $order_total);
            $stmt->execute();

            // Get the order ID
            $order_id = $conn->lastInsertId();

            // Insert order details into tbl_order_detail
            foreach ($meals as $meal) {
                $meal_id = $meal['id'];
                $quantity = $meal['quantity'];
                $price = $meal['discount_price'];

                // Retrieve meal price from tbl_meal_price
                // $meal_price_stmt = $conn->prepare("SELECT meal_price FROM tbl_meal_price WHERE meal_id = :meal_id");
                // $meal_price_stmt->bindParam(':meal_id', $meal_id);
                // $meal_price_stmt->execute();
                // $meal_price = $meal_price_stmt->fetchColumn();

                // Insert order detail
                $stmt = $conn->prepare("INSERT INTO tbl_order_detail (order_id, meal_id, meal_quantity, meal_price) VALUES (:order_id, :meal_id, :quantity, :meal_price)");
                $stmt->bindParam(':order_id', $order_id);
                $stmt->bindParam(':meal_id', $meal_id);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':meal_price', $price);
                $stmt->execute();

                // Update order total
                $order_total += ($quantity * $meal_price);
            }

            // Update total in tbl_order
            // $update_total_stmt = $conn->prepare("UPDATE tbl_order SET order_total = :order_total WHERE order_id = :order_id");
            // $update_total_stmt->bindParam(':order_total', $order_total);
            // $update_total_stmt->bindParam(':order_id', $order_id);
            // $update_total_stmt->execute();

            // Commit the transaction
            $conn->commit();

            // Send a success response
            echo json_encode(['success' => true]);
            
        } catch (Exception $e) {
            // Rollback the transaction on error
            $conn->rollBack();
            echo json_encode(['error' => 'Error placing order: ' . $e->getMessage()]);
        }
        $conn->autocommit(true);
    } else {
        echo json_encode(['error' => 'Invalid data provided']);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['error' => 'Invalid request method']);
}

?>
