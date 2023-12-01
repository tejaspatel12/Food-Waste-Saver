<?php
header("Content-Type: application/json");

include '../connection.php';

// Assuming you have a database connection
// $servername = "your_server_name";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database_name";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the request
$userId = $_GET['user_id'];

// Fetch order history for the given user ID
$sql = "SELECT o.order_id, o.restaurant_id, o.order_date, o.order_hour, o.order_total, 
               m.meal_name, m.meal_price, m.meal_description, m.meal_image,
               f.rating, f.feedback_comment
        FROM tbl_order o
        INNER JOIN tbl_meal m ON o.restaurant_id = m.restaurant_id
        LEFT JOIN feedback f ON o.order_id = f.order_id
        WHERE o.member_id = $userId
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $orderHistory = array();

    while ($row = $result->fetch_assoc()) {
        $orderHistory[] = array(
            "order_id" => intval($row["order_id"]),
            "restaurant_id" => intval($row["restaurant_id"]),
            "order_date" => $row["order_date"],
            "order_hour" => $row["order_hour"],
            "order_total" => doubleval($row["order_total"]),
            "meal_name" => $row["meal_name"],
            "meal_price" => doubleval($row["meal_price"]),
            "meal_description" => $row["meal_description"],
            "meal_image" => $row["meal_image"],
            "rating" => ($row["rating"] != null) ? intval($row["rating"]) : null,
            "feedback_comment" => ($row["feedback_comment"] != null) ? $row["feedback_comment"] : null,
        );
    }

    echo json_encode($orderHistory);
} else {
    echo json_encode(array());
}

$conn->close();
?>
