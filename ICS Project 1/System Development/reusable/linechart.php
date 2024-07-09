<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget and Expenditure Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Budget and Expenditure Chart</h1>
    <div class="form-group">
        <label for="duration">Select Duration:</label>
        <select id="duration" class="form-control">
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
        </select>
    </div>
    <canvas id="myChart"></canvas>
</div>

<script>
document.getElementById('duration').addEventListener('change', function() {
    fetchDataAndRenderChart(this.value);
});

function fetchDataAndRenderChart(duration) {
    fetch(`path_to_your_php_script.php?duration=${duration}`)
        .then(response => response.json())
        .then(data => {
            const labels = Object.keys(data.expenditures).map(key => duration === 'weekly' ? `Week ${key}` : `Month ${key}`);
            const expenditures = Object.values(data.expenditures);
            const budgets = Object.values(data.budgets);

            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Expenditure',
                            data: expenditures,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: true,
                        },
                        {
                            label: 'Budget',
                            data: budgets,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
}

// Initial load
fetchDataAndRenderChart('monthly');
</script>
</body>
</html>

