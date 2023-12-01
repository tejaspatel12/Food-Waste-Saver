<?php
// Connect to your database
// $servername = "your_server";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database";


include '../../admin/connection.php';


// $conn = new mysqli($servername, $username, $password, $dbname);
// $conn=mysqli_connect("localhost","activrm2_foodwaste","Active4u.","activrm2_foodwaste") or die(mysqli_error($conn));

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch order data
$sql = "SELECT MONTH(order_date) as month, SUM(order_total) as total 
        FROM tbl_order 
        WHERE YEAR(order_date) = 2023
        GROUP BY MONTH(order_date)";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Convert data to JSON format
echo json_encode($data);

$conn->close();
?>
