<?php
include '../../admin/connection.php';
if (isset($_POST['restaurant_id'])) {
    $restaurantId = $_POST['restaurant_id'];

    // Perform a query to get meals based on the selected restaurant ID
    $result = mysqli_query($conn, "SELECT * FROM tbl_meal WHERE restaurant_id = $restaurantId");

    // Display meal options
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value="' . $row["meal_id"] . '">' . $row["meal_name"] . '</option>';
    }
}
?>