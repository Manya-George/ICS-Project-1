    document.addEventListener('DOMContentLoaded', function() {
    var budgetCounter = 0;
    var budgetsContainer = document.getElementById('budgetsContainer');
    var addBudgetButton = document.getElementById('addBudget');
    var expensesTable = document.getElementById('expensesTable');
    var totalBudgetElement = document.getElementById('totalBudget');
    var totalExpenditureElement = document.getElementById('totalExpenditure');
    var balanceElement = document.getElementById('balance');

    addBudgetButton.addEventListener('click', function() {
        budgetCounter++;
        var budgetRow = document.createElement('tr');
        budgetRow.innerHTML = `
            <td><input type="number" class="form-control" id="budgetAmount${budgetCounter}" required></td>
            <td>
                <select class="form-select" id="budgetType${budgetCounter}" required>
                    <option value="">Select Type</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </td>
        `;
        budgetsContainer.appendChild(budgetRow);
    });

    var budgetForm = document.getElementById('budgetForm');
    budgetForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var budgets = [];
        var totalBudget = 0;

        // Collect budget amounts and types
        var budgetAmountInputs = document.querySelectorAll('#budgetsContainer input[type="number"]');
        var budgetTypeSelects = document.querySelectorAll('#budgetsContainer select');

        for (var i = 0; i < budgetAmountInputs.length; i++) {
            var budgetAmount = parseFloat(budgetAmountInputs[i].value);
            var budgetType = budgetTypeSelects[i].value;
            
            if (!isNaN(budgetAmount) && budgetType) {
                budgets.push({ amount: budgetAmount, type: budgetType });
                totalBudget += budgetAmount;
            }
        }

        // Update total budget display
        totalBudgetElement.textContent = `$${totalBudget.toFixed(2)}`;

        // Simulated API call - Replace with actual fetch to backend
        simulatePostRequest('/saveBudgets', { budgets: budgets })
            .then(data => {
                if (data.success) {
                    alert('Budgets saved successfully.');
                    updateCharts(budgets);
                } else {
                    alert('Failed to save budgets.');
                }
            });
    });

    function simulatePostRequest(url, data) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve({ success: true }); // Simulated success response
            }, 1000); // Simulate delay for demonstration
        });
    }

    function updateCharts(budgets) {
        var weeklyLabels = [];
        var weeklyBudgetData = [];
        var monthlyLabels = [];
        var monthlyBudgetData = [];

        budgets.forEach(budget => {
            if (budget.type === 'Weekly') {
                weeklyLabels.push(`Week ${weeklyLabels.length + 1}`);
                weeklyBudgetData.push(budget.amount);
            } else if (budget.type === 'Monthly') {
                for (var i = 1; i <= 4; i++) { // Monthly budget maps to 4 points
                    monthlyLabels.push(`Month ${monthlyLabels.length + 1} - Week ${i}`);
                    monthlyBudgetData.push(budget.amount);
                }
            }
        });

        // Update line chart data for weekly budgets
        lineChart.data.datasets[1].data = weeklyBudgetData;
        lineChart.data.datasets[1].label = 'Weekly Budget';
        lineChart.data.datasets[1].borderColor = '#F6A264';

        // Update line chart data for monthly budgets
        lineChart.data.datasets[2].data = monthlyBudgetData;
        lineChart.data.datasets[2].label = 'Monthly Budget';
        lineChart.data.datasets[2].borderColor = '#65A0C6';
        lineChart.data.labels = weeklyLabels.concat(monthlyLabels);

        lineChart.update();
    }

    // Chart.js setup for line chart
    var lineCtx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Expenditure',
                data: [],
                borderColor: '#23297A',
                tension: 0.1,
                fill: false
            }, {
                label: 'Weekly Budget',
                data: [],
                borderColor: '#F6A264',
                tension: 0.1,
                fill: false
            }, {
                label: 'Monthly Budget',
                data: [],
                borderColor: '#65A0C6',
                tension: 0.1,
                fill: false
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

    // Handle expense form submission
    var expenseForm = document.getElementById('expenseForm');
    expenseForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var expenseName = document.getElementById('expenseName').value;
        var expenseAmount = parseFloat(document.getElementById('expenseAmount').value);
        var expenseType = document.getElementById('expenseType').value;
        var dateofPayment = document.getElementById('dateofPayment').value;

        if (expenseName && !isNaN(expenseAmount) && expenseType && dateofPayment) {
            // Simulated API call - Replace with actual fetch to backend
            simulatePostRequest('/addExpense', { name: expenseName, amount: expenseAmount, type: expenseType, date: dateofPayment })
                .then(data => {
                    if (data.success) {
                        alert('Expense added successfully.');
                        updateExpenseCharts(expenseName, expenseAmount, expenseType, dateofPayment);
                    } else {
                        alert('Failed to add expense.');
                    }
                });

            // Update expense table
            var expenseRow = document.createElement('tr');
            expenseRow.innerHTML = `
                <td>${expenseName}</td>
                <td>${expenseAmount}</td>
                <td>${expenseType}</td>
                <td>${dateofPayment}</td>
            `;
            expensesTable.appendChild(expenseRow);

            // Update total expenditure and balance
            var currentTotalExpenditure = parseFloat(totalExpenditureElement.textContent.slice(1)); // Remove '$' and parse float
            totalExpenditureElement.textContent = `$${(currentTotalExpenditure + expenseAmount).toFixed(2)}`;
            var currentTotalBudget = parseFloat(totalBudgetElement.textContent.slice(1)); // Remove '$' and parse float
            balanceElement.textContent = `$${(currentTotalBudget - (currentTotalExpenditure + expenseAmount)).toFixed(2)}`;

            // Clear form inputs for room
            document.getElementById('expenseName').value = '';
            document.getElementById('expenseAmount').value = '';
            document.getElementById('expenseType').value = '';
        } else {
            alert('Please fill out all fields.');
        }
    });

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
});

    