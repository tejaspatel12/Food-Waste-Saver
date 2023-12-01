<?php
session_start();
include 'connection.php';
if(!isset($_SESSION["admin_id"]))
{
    echo "<script>window.location='login.php';</script>";
}

$meals = [];

if (isset($_REQUEST['orderID'])) {
    $orderId = $_REQUEST['orderID'];

    // Include your database connection code here

    // Use a prepared statement to avoid SQL injection
    $query = "SELECT m.meal_id, m.meal_name, m.meal_image, m.meal_price 
              FROM tbl_order_detail AS od 
              LEFT JOIN tbl_meal AS m ON m.meal_id = od.meal_id 
              WHERE od.order_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the order ID as a parameter
        mysqli_stmt_bind_param($stmt, "i", $orderId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the result set
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                // Build the meal array for each row
                $meal = [
                    'id' => $row['meal_id'],
                    'name' => $row['meal_name'],
                    'image' => $row['meal_image'],
                    'price' => $row['meal_price']
                ];

                $meals[] = $meal;
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle the case where the statement execution failed
            echo json_encode(['error' => 'Failed to execute the query']);
        }
    } else {
        // Handle the case where the prepared statement couldn't be created
        echo json_encode(['error' => 'Failed to prepare the statement']);
    }
} else {
    // Handle the case where the 'id' parameter is not provided
    echo json_encode(['error' => 'Missing order ID']);
}

// Output the JSON response
echo json_encode($meals);
?>