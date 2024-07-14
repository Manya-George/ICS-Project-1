<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/webp" href="../Images/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Savings Calculator</title>
    <style >
        body {
            font-family: Arial, sans-serif;
            background-color: lightskyblue;
        }
    </style>
</head>
<body style="background-color: #E6E6EE;">
    <div class="container">
        <div class="row">
    <div class="container-fluid mt-2 mx-4">
        <div class="row">
            <div style="background: white; border-radius: 50px;" class="mt-3">
                <div class="justify-content-center">            
                    <div class="container px-4 py-4 pb-4 pt-4">
                        <h1>50/30/20 Saving Calculator with 16% Tax</h1>
                        <p> A penny saved is a penny earned.</p>
                        <label for="income">Monthly income:</label>
                        <input type="number" id="income" step="0.01" required><br><br>

                        <input class="btn text-white px-5 py-2 mt-4 mb-4" type="submit" id="calculate" name="calculate" value="Calculate" style="background-color: #8282AB; border-radius: 20px;" onclick="calculate();"> 

                        <p id="Spending"></p>
                        <p id="Investment"></p>
                        <p id="Savings"></p>
                        <p id="Tax"></p>
                    </div>
                    <script>
                        function calculate() {
                            var income = parseFloat(document.getElementById("income").value);
                            var Tax = (income * 0.16).toFixed(2);
                            var afterTaxIncome = income - parseFloat(Tax);
                            var Spending = (afterTaxIncome * 0.5).toFixed(2);
                            var Investment= (afterTaxIncome * 0.3).toFixed(2);
                            var Savings = (afterTaxIncome * 0.2).toFixed(2);

                            document.getElementById("Spending").innerHTML = "Spending (50%): KSH" + Spending;
                            document.getElementById("Investment").innerHTML = "Investment (30%): KSH" + Investment;
                            document.getElementById("Savings").innerHTML = "Savings (20%): KSH" + Savings;
                            document.getElementById("Tax").innerHTML = "Tax (16%): KSH" + Tax;
                        }
                    </script>
                </div>                      
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 mx-4 mb-2">
        <div class="row">
            <div style="background: white; border-radius: 50px;" class="mt-3">
                <div class="justify-content-center">
                    <div class="container px-4 py-4 pb-4 pt-4">
                        <h1>Compound Interest Calculator</h1>
                        <label for="principal">Principal Amount:</label>
                        <input type="number" id="principal" step="0.01" required><br><br>

                        <label for="rate">Annual Interest Rate (as a decimal):</label>
                        <input type="number" id="rate" step="0.01" required><br><br>

                        <label for="time">Number of Years:</label>
                        <input type="number" id="time" required><br><br>

                        <input class="btn text-white px-5 py-2 mt-4 mb-4" type="submit" id="calculate" name="calculate" value="Calculate" style="background-color: #8282AB; border-radius: 20px;" onclick="calculateCompoundInterest();">

                        <p id="result"></p>
                    </div>
                    <script>
                        function calculateCompoundInterest() {
                            var principal = parseFloat(document.getElementById("principal").value);
                            var rate = parseFloat(document.getElementById("rate").value);
                            var time = parseInt(document.getElementById("time").value);

                            var amount = principal * Math.pow(1 + rate, time);
                            var result = "Total amount after compound interest: KSH" + amount.toFixed(2);

                            document.getElementById("result").textContent = result;
                        }
                    </script>                                 
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</html>