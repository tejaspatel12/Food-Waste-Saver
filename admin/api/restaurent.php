<?php
include '../connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if latitude and longitude are provided in the POST request
$userLatitude = isset($_POST["latitude"]) ? $_POST["latitude"] : null;
$userLongitude = isset($_POST["longitude"]) ? $_POST["longitude"] : null;

if ($userLatitude === null || $userLongitude === null) {
    die("Latitude or longitude not provided.");
}

// Search radius in kilometers
$searchRadius = 10; // Adjust as needed

// Using prepared statements to prevent SQL injection
$sql = "SELECT *, (
    6371 * ACOS(
        COS(RADIANS(?)) * COS(RADIANS(restaurant_latitude)) *
        COS(RADIANS(restaurant_longitude) - RADIANS(?)) +
        SIN(RADIANS(?)) * SIN(RADIANS(restaurant_latitude))
    )
) AS distance
FROM tbl_restaurant
HAVING distance < ?
ORDER BY distance";

$stmt = $conn->prepare($sql);
$stmt->bind_param("dddd", $userLatitude, $userLongitude, $userLatitude, $searchRadius);

try {
    $stmt->execute();
    $result = $stmt->get_result();

    $restaurants = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $restaurants[]=$row;
            // $restaurants[] = array(
            //     "restaurant_id" => $row["restaurant_id"],
            //     "restaurant_name" => $row["restaurant_name"],
            //     "restaurant_location" => $row["restaurant_location"]
            //     "distance" => $row["distance"]
            // );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($restaurants);
} catch (Exception $e) {
    error_log('Error executing query: ' . $e->getMessage());
    echo json_encode(array("error" => "Error fetching nearby restaurants."));
} finally {
    $stmt->close();
    $conn->close();
}
?>
