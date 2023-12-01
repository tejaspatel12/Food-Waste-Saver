<?php
// Include your database connection file
include '../../admin/connection.php';

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch order data for the day
$sql = "SELECT DAY(order_date) as day, SUM(order_total) as total FROM tbl_order GROUP BY DAY(order_date)";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Convert data to JSON format
echo json_encode($data);

// Close the database connection
$conn->close();
?>
