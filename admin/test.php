<?php
// Database connection
session_start();
include 'connection.php';
$title = "Restaurent Details";
$code = "restaurent_details";
$status = "1";
if(!isset($_SESSION["admin_id"]))
{
    echo "<script>window.location='login.php';</script>";
}

// Date range
$start_date = new DateTime('2023-01-01');
$end_date = new DateTime('2023-10-27'); 

// Peak hours array  
$peak_hours = range(17, 21);

while($start_date <= $end_date) {

  // Random orders per day
  $orders_per_day = rand(1, 300);

  for($i=1; $i<=$orders_per_day; $i++) {

    // Order details 
    $order_date = $start_date->format('Y-m-d');
    // $order_time = date('H:i:s');
    $cust_id = rand(1, 1000);

    // Initialize order total
    $order_total = 0;
    $restaurant_id = 1;

    // Randomly pick peak or non-peak time
    $rand = mt_rand(1, 100);
    if($rand <= 70) {
      $hour = $peak_hours[array_rand($peak_hours)]; 
    } else {
      $hour = mt_rand(11, 16);
    }
    
    $mins = mt_rand(0, 59);
    $order_time = $hour .':'. $mins .':'.$sec = mt_rand(00, 59);


    // Insert order
    $stmt = $conn->prepare("INSERT INTO tbl_order (restaurant_id, order_date, order_hour, member_id, order_total)
                            VALUES (?, ?, ?, ?, ?)");
    
    $stmt->bind_param('issdi', $restaurant_id, $order_date, $order_time, $cust_id, $order_total);
    
    if(!$stmt->execute()) {
      die("Order insert failed: " . $stmt->error);
    }

    // Get order id
    $order_id = $conn->insert_id;

    // Random meals
    $num_meals = rand(1, 5);

    // Add meals
    for($j=1; $j<=$num_meals; $j++) {
    
      // Get random meal
      $meal_id = rand(1, 10);
      
      // Get meal price  
      $stmt = $conn->prepare("SELECT meal_price FROM tbl_meal WHERE meal_id = ?");
      $stmt->bind_param('i', $meal_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $meal_price = $result->fetch_assoc()['meal_price'];
      
      // Insert meal item
      $stmt = $conn->prepare("INSERT INTO tbl_order_detail (order_id, meal_id) VALUES (?, ?)");
      $stmt->bind_param('ii', $order_id, $meal_id);
      
      if(!$stmt->execute()) {
        die("Meal insert failed: " . $stmt->error);  
      }

      // Update order total
      $order_total += $meal_price; 
      
    }

    // Update order total 
    $stmt = $conn->prepare("UPDATE tbl_order SET order_total = ? WHERE order_id = ?");
    $stmt->bind_param('di', $order_total, $order_id);  
    $stmt->execute();

  }

  // Next date
  $start_date->modify('+1 day'); 

}

// Close connection
mysqli_close($conn);
?>