@extends('layouts._master')

@section('stylesheet')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function processData(stats) {
            var dailyCounts = {};
            // Process the stats data to count distributions per day
            stats.forEach(function(entry) {
                var date = entry.created_at.split('T')[0]; // Extracting the date part
                dailyCounts[date] = (dailyCounts[date] || 0) + 1;
            });

            // Convert the processed data to an array for Google Charts
            var chartData = [
                ['Date', 'Click Count']
            ];
            for (var date in dailyCounts) {
                chartData.push([date, dailyCounts[date]]);
            }

            return chartData;
        }

        function drawChart() {
            // Replace the static data with your dynamic data
            // var stats = <?php echo $stats; ?>;
            var stats = <?php echo json_encode($stats); ?>;
            console.log(stats);

            var data = google.visualization.arrayToDataTable(processData(stats));

            var options = {
                title: 'Daily Link Click',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);


            var actionDivs = document.querySelectorAll('.actions .action');
            actionDivs.forEach(function(actionDiv) {
                actionDiv.addEventListener('click', function() {
                    // Remove 'active' class from all action divs
                    actionDivs.forEach(function(div) {
                        div.classList.remove('active');
                    });

                    // Add 'active' class to the clicked action div
                    actionDiv.classList.add('active');

                    // Show the corresponding div under the actions
                    showDetails(actionDiv.textContent.trim());
                });
            });
        }

        function showDetails(action) {
            // Implement logic to show/hide details based on the clicked action
            console.log('Clicked action:', action);

            // Hide all details divs
            var detailsDivs = document.querySelectorAll('.details .details-content');
            detailsDivs.forEach(function(detailsDiv) {
                detailsDiv.style.display = 'none';
            });

            // Show the corresponding details div only if an action is clicked
            if (action) {
                var selectedDetailsDiv = document.querySelector('.details .details-' + action.toLowerCase());
                if (selectedDetailsDiv) {
                    selectedDetailsDiv.style.display = 'block';
                }
            }
        }

        function animateProgressBar(progressBar, values) {
            var index = 0;
            var interval = setInterval(function() {
                progressBar.style.width = values[index] + '%';
                progressBar.setAttribute('aria-valuenow', values[index]);

                index++;
                if (index >= values.length) {
                    clearInterval(interval);
                }
            }, 500); // Adjust the animation speed as needed
        }
    </script>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Link Details</h1>
            </div>

            <div class="details">
                <div id="curve_chart" style="width: 100%; height: 100%"></div>
                <div class="stats">
                    <div class="actions">
                        <button class="action">Country</button>
                        <button class="action">City</button>
                        <button class="action">Distination</button>
                        <button class="action">Platform</button>
                        <button class="action">Device</button>
                        <button class="action">Browser</button>
                        <button class="action">Export Data</button>
                    </div>
                    <div class="actions-content">
                        @include('pages.user.links.details.country')
                        @include('pages.user.links.details.city')
                        @include('pages.user.links.details.distination')
                        @include('pages.user.links.details.platform')
                        @include('pages.user.links.details.device')
                        @include('pages.user.links.details.browser')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
