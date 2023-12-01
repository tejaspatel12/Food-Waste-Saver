<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;

    // Check if the required data is present
    if (
        isset($data['restaurant_name'], $data['restaurant_number'], $data['restaurant_mail'],
        $data['restaurant_password'], $data['restaurant_location'], $data['city_id'],
        $data['restaurant_latitude'], $data['restaurant_longitude'], $data['veg_nonveg'])
    ) {
        // Extract data
        $restaurant_name = $data['restaurant_name'];
        $restaurant_number = $data['restaurant_number'];
        $restaurant_mail = $data['restaurant_mail'];
        $restaurant_password = $data['restaurant_password'];
        $restaurant_location = $data['restaurant_location'];
        $city_id = $data['city_id'];
        $restaurant_latitude = $data['restaurant_latitude'];
        $restaurant_longitude = $data['restaurant_longitude'];
        $veg_nonveg = $data['veg_nonveg'];

        // Check if a file was uploaded
        if (isset($_FILES['restaurant_image'])) {
            $file_name = $_FILES['restaurant_image']['name'];
            $file_tmp = $_FILES['restaurant_image']['tmp_name'];

            // Move the uploaded file to a desired location
            move_uploaded_file($file_tmp, '../assets/images/restaurant/' . $file_name);

            // Include your database connection file
            include '../connection.php';

            try {
                // Insert restaurant data into tbl_restaurant
                $stmt = $conn->prepare("INSERT INTO tbl_restaurant (restaurant_name, restaurant_image, restaurant_number, restaurant_mail, restaurant_password, restaurant_location, city_id, restaurant_latitude, restaurant_longitude, veg_nonveg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ssssssidds', $restaurant_name, $file_name, $restaurant_number, $restaurant_mail, $restaurant_password, $restaurant_location, $city_id, $restaurant_latitude, $restaurant_longitude, $veg_nonveg);
                $stmt->execute();

                // Send a success response
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                // Handle database error
                echo json_encode(['error' => 'Error adding restaurant: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'No image file uploaded']);
        }
    } else {
        echo json_encode(['error' => 'Invalid data provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
