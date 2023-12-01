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
$end_date = new DateTime('2023-01-31'); 

// Peak hours array  
$peak_hours = range(17, 21);

while($start_date <= $end_date) {

  // Random orders per day
  $orders_per_day = rand(1, 5);

  for($i=1; $i<=$orders_per_day; $i++) {

    // Order details 
    $order_date = $start_date->format('Y-m-d');
    echo "order_date : ".$order_date."<br>";
    // $order_time = date('H:i:s');
    $cust_id = rand(1, 20);

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


    // Get order id
    $order_id = $conn->insert_id;

    // Random meals
    $num_meals = rand(1, 3);

    // Add meals
    for($j=1; $j<=$num_meals; $j++) {
    
      // Get random meal
      $meal_id = rand(1, 10);

      echo "meal_id : "+$meal_id."<br><br>";
      

      
    }

  }

  // Next date
  $start_date->modify('+1 day'); 

}

// Close connection
mysqli_close($conn);
?>