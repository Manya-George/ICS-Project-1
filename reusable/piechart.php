<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <canvas id="expensePieChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('expensePieChart').getContext('2d');

        const data = {
            labels: <?php echo json_encode($categories); ?>,
            datasets: [{
                data: <?php echo json_encode($amounts); ?>,
                backgroundColor: [
                    '#F6A264',
                    '#5EC488',
                    '#3D5492',
                    '#7A3D92'
                ],
                borderColor: [
                    '#F6A264',
                    '#5EC488',
                    '#3D5492',
                    '#7A3D92'
                ],
                hoverOffset: 4,
                borderWidth: 1
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom' // Move the legend to the bottom
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let total = 0;
                                tooltipItem.dataset.data.forEach(amount => {
                                    total += amount;
                                });
                                const percentage = ((tooltipItem.raw / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: Ksh ${tooltipItem.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };

        const expensePieChart = new Chart(ctx, config);
    </script>
</body>
</html>
