
<?php
	include '../admin/connection.php';
?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<div class="card-body">
    <div id="chartmonth"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch data using AJAX
        fetch('order_month.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data); // Log received data for debugging

                if (isValidChartData(data)) {
                    renderChart(data);
                } else {
                    console.error('Invalid or empty data received:', data);
                }
            })
            .catch(error => console.error('Error fetching or parsing data:', error));

        // Function to check if data is valid for chart rendering
        function isValidChartData(data) {
            return Array.isArray(data) && data.length > 0 && data[0]?.hasOwnProperty('month') && data[0]?.hasOwnProperty('total');
        }

        // Function to render the chart
        function renderChart(data) {
            var options = {
                series: [{
                    name: 'Revenue',
                    data: data.map(item => parseFloat(item.total))
                }],
                xaxis: {
                    categories: data.map(item => getMonthName(parseInt(item.month)))
                },
                // Add your other chart options here
            };

            // Create the chart
            var chart = new ApexCharts(document.querySelector("#chartmonth"), options);
            chart.render();
        }

        // Function to get month name from month number
        function getMonthName(monthNumber) {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return months[monthNumber - 1];
        }
    });
</script>
