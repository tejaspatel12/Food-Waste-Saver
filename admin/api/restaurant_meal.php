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

// Get the restaurant ID from the request
$restaurantId = $_GET['restaurant_id'];


// Fetch meals for the given restaurant ID
$sql = "SELECT * FROM tbl_meal WHERE restaurant_id = $restaurantId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $meals = array();

    while ($row = $result->fetch_assoc()) {
        
        $discount = 40;
        $price = ($row["meal_price"] * ($discount / 100));
        
        $meals[]=array(
            // "meal_id" => $row["meal_id"],
            // "restaurant_id" => $row["restaurant_id"],
            // "meal_type" => $row["meal_type"],
            
            "meal_id" => intval($row["meal_id"]),
            "restaurant_id" => intval($row["restaurant_id"]),
            "meal_type" => intval($row["meal_type"]),
            "hot_cold" => $row["hot_cold"],
            "meal_image" => $row["meal_image"],
            "meal_name" => $row["meal_name"],
            // "meal_price" => $row["meal_price"],
            "meal_price" => doubleval($row["meal_price"]),
            "meal_discount_price" => intval($price),
            "meal_description" => $row["meal_description"],
            
            
            // "product_min_qty" => intval($row["product_min_qty"]),
        );
                    
    }
    echo json_encode($meals);
} else {
    echo json_encode(array());
}

$conn->close();
?>
