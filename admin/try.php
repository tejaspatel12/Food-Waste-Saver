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

// Number of rows
$num_rows = mt_rand(1, 2);  

// Generate data
for($i=1; $i<=$num_rows; $i++) {

  // Name
  // $first_name = $first_names[array_rand($first_names)];
  // $last_name = $last_names[array_rand($last_names)];

  // Email 
  // $email = strtolower($first_name) . '.' . strtolower($last_name) . '@example.com';

  // Gender
  $gender = mt_rand(0, 1) ? 'Male' : 'Female';

  // Insert 
  $insert_query = "INSERT INTO tbl_member (member_name, member_gender, member_email) 
                          VALUES ('tehjashg', '$gender', '1')";
        $conn->query($insert_query);


  // $stmt = $conn->prepare("INSERT INTO tbl_member (member_name, member_gender, member_email) 
  //                         VALUES(?, ?, ?)");
                          
  // $stmt->bind_param($first_name.' '.$last_name, $gender, $email);
  
  // $stmt->execute();
  
} 

mysqli_close($conn);
?>