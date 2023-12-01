<?php
// Include necessary libraries or connect to the database
include '../admin/connection.php';

// Fetch data from the database to count meal orders
$result = mysqli_query($conn, "SELECT meal_name, COUNT(*) as order_count FROM tbl_order_detail 
    JOIN tbl_meal ON tbl_order_detail.meal_id = tbl_meal.meal_id 
    GROUP BY meal_name");

// Initialize arrays to store data for the chart
$meal_names = [];
$order_counts = [];

while ($row = mysqli_fetch_array($result)) {
    $meal_names[] = $row['meal_name'];
    $order_counts[] = $row['order_count'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meal Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: 0 auto;">
        <canvas id="mealChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('mealChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($meal_names); ?>,
                datasets: [{
                    label: 'Number of Orders',
                    data: <?php echo json_encode($order_counts); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
