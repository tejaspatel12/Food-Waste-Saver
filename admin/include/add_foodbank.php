<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;

    // Check if the required data is present
    if (
        isset($data['foodbank_name'], $data['foodbank_number'], $data['foodbank_mail'],
        $data['foodbank_password'], $data['foodbank_location'], $data['city_id'],
        $data['foodbank_latitude'], $data['foodbank_longitude'], $data['foodbank_des'])
    ) {
        // Extract data
        $foodbank_name = $data['foodbank_name'];
        $foodbank_number = $data['foodbank_number'];
        $foodbank_mail = $data['foodbank_mail'];
        $foodbank_password = $data['foodbank_password'];
        $foodbank_location = $data['foodbank_location'];
        $city_id = $data['city_id'];
        $foodbank_latitude = $data['foodbank_latitude'];
        $foodbank_longitude = $data['foodbank_longitude'];
        $foodbank_des = $data['foodbank_des'];

        // Check if a file was uploaded
        if (isset($_FILES['foodbank_image'])) {
            $file_name = $_FILES['foodbank_image']['name'];
            $file_tmp = $_FILES['foodbank_image']['tmp_name'];

            // Move the uploaded file to a desired location
            move_uploaded_file($file_tmp, '../assets/images/foodbank/' . $file_name);

            // Include your database connection file
            include '../connection.php';

            try {
                // Insert food bank data into tbl_foodbank
                $stmt = $conn->prepare("INSERT INTO tbl_foodbank (foodbank_name, foodbank_des, foodbank_image, foodbank_number, foodbank_mail, foodbank_password, foodbank_location, city_id, foodbank_latitude, foodbank_longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ssssssidsdd', $foodbank_name, $foodbank_des, $file_name, $foodbank_number, $foodbank_mail, $foodbank_password, $foodbank_location, $city_id, $foodbank_latitude, $foodbank_longitude);


                $stmt->execute();

                // Send a success response
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                // Handle database error
                echo json_encode(['error' => 'Error adding Food Bank: ' . $e->getMessage()]);
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