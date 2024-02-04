<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicks Over Days</title>
    <!-- Include Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Replace this with the actual data returned from your PHP controller
            var returnedData = <?php echo json_encode($stats); ?>;

            // Preprocess the data to group by date and calculate total clicks for each date
            var groupedData = {};
            for (var i = 1; i < returnedData.length; i++) {
                // Assuming the timestamp is in seconds, multiply by 1000 for milliseconds
                var date = new Date(returnedData[i][0] * 1000);

                // Check if the date is valid before formatting
                if (!isNaN(date.getTime())) {
                    var formattedDate = date.toISOString().split('T')[0];

                    if (groupedData[formattedDate]) {
                        groupedData[formattedDate] += returnedData[i][1];
                    } else {
                        groupedData[formattedDate] = returnedData[i][1];
                    }
                }

                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Date');
                data.addColumn('number', 'Clicks');

                // Add data from the grouped data
                for (var date in groupedData) {
                    data.addRow([date, groupedData[date]]);
                }

                // Set chart options.
                var options = {
                    title: 'Clicks Over Days',
                    curveType: 'function',
                    legend: {
                        position: 'bottom'
                    }
                };

                // Instantiate and draw the chart.
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
            }
    </script>
</head>

<body>
    <!-- Display the chart -->
    <div id="curve_chart" style="width: 900px; height: 500px;"></div>
</body>

</html>
