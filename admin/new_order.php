<?php
// Database connection settings
session_start();
include 'connection.php';
$title = "Restaurent Details";
$code = "restaurent_details";
$status = "1";
if(!isset($_SESSION["admin_id"]))
{
    echo "<script>window.location='login.php';</script>";
}

$restaurant_id = 1;

// Date range settings
$start_date = new DateTime('2023-01-01');
$end_date = new DateTime('2023-01-31');

// Generate random orders
while ($start_date <= $end_date) {
    $num_orders = rand(1, 5); // Random number of orders per day

    for ($i = 1; $i <= $num_orders; $i++) {
        $order_date = $start_date->format('Y-m-d');
        $customer_id = $i;
        $num_meals = rand(1, 10); // Random number of meals per order
        // $num_drinks = 1; // One drink per order
        $num_meals = rand(1, 3); // Random number of meals per order
        $order_total = 0; // Initialize order total

        $hour = mt_rand(11, 22);
        // Generate a random minute between 0 and 59
        $minute = mt_rand(0, 59);
        // Generate a random Second between 0 and 59
        $second = mt_rand(0, 59);

        // $time = $hour.":".$minute.":".$second;
        $time = '10:10:00';

        // Insert the order into the database
        $insert_query = "INSERT INTO tbl_order (restaurant_id, order_date, order_date, member_id, order_total) 
                         VALUES ($restaurant_id, '$order_date', '$time', $customer_id, '10')";
        $conn->query($insert_query);

        // Generate and insert meal details
        for ($j = 1; $j <= $num_meals; $j++) {
            $meal_id = rand(1, 9); // Random meal ID
            // Query to fetch meal price based on meal_id
            $meal_price_query = "SELECT meal_price FROM tbl_meal WHERE meal_id = $meal_id";
            $meal_price_result = $conn->query($meal_price_query);
            $meal_price = $meal_price_result->fetch_assoc()['meal_price'];
            $order_total += $meal_price; // Update order total
            // Insert meal details into the order
            $insert_meal_query = "INSERT INTO tbl_order_detail (order_id, meal_id) 
                                 VALUES (LAST_INSERT_ID(), $meal_id)";
            $conn->query($insert_meal_query);
        }   
    }
    // Move to the next date
    $start_date->modify('+1 day');
}

// Close the database connection
$mysqli->close();
?>
