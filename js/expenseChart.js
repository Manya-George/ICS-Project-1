function updateExpenseCharts(name, amount, type) {
    // Update pie chart data
    var currentData = pieChart.data.datasets[0].data;
    var currentIndex = pieChart.data.labels.indexOf(type);
    if (currentIndex !== -1) {
        currentData[currentIndex] += amount;
    } else {
        pieChart.data.labels.push(type);
        currentData.push(amount);
    }
    pieChart.update();

    // Update line chart data
    lineChart.data.labels.push(name);
    lineChart.data.datasets[0].data.push(amount);
    lineChart.update();
}

// Chart.js setup for pie chart
var pieCtx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: [],
        datasets: [{
            label: 'Expenditure by Category',
            data: [],
            backgroundColor: [
                '#F6A264',
                '#5EC488',
                '#3D5492',
                '#7A3D92'
            ],
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});