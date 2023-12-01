<?php
session_start();
include '../../admin/connection.php';
if(!isset($_SESSION["foodbank_id"]))
{
	echo "<script>window.location='../login.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $surplusId = $_POST['surplusId'];
    $quantity = $_POST['quantity'];
    
    $result=mysqli_query($conn,"select * from tbl_surplus_meals where surplus_id='".$surplusId."'");
    while($row=mysqli_fetch_array($result))
    {
      $meal = $row['meal_id'];  
      $surplus_quantity = $row['surplus_quantity'];  
    }
    
    $total = $surplus_quantity - $quantity;

    // Insert data into tbl_foodbank_meal
    $sql = "INSERT INTO tbl_foodbank_meal (surplus_id, food_bank_id, meal_id, fbm_quantity) VALUES ($surplusId, '".$_SESSION["foodbank_id"]."', $meal, $quantity)";
    
     $result1=mysqli_query($conn,"UPDATE `tbl_surplus_meals` SET surplus_quantity='$total' WHERE surplus_id='$surplusId'") or die(mysqli_error($conn));
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
}
?>
