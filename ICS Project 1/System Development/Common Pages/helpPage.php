<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/webp" href="../Images/Logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <title>Help Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: lightskyblue;
    }
    .container {
        max-width: 1200px;
        margin: 100px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .message-container {
        margin-bottom: 20px;
    }
    .message {
        max-width: 70%;
        padding: 10px;
        border-radius: 8px;
        clear: both;
        margin-bottom: 10px;
    }
    .message.bot {
        background-color: #007bff;
        color: #fff;
        float: left;
    }
    .message.user {
        background-color: #e9ecef;
        float: right;
    }
    .message-content {
        margin-bottom: 5px;
    }
    .message-timestamp {
        font-size: 12px;
        color: #aaa;
    }
    .form-group {
        margin-bottom: 20px;
    }
</style>
</head>
<body>
<body style="background-color: #E6E6EE;">
        <div class="container-fluid mt-2">
            <div class="row">
                <?php
                    include "../reusable/sidebar.php";
                ?>
            <div class="col-10 my-2 mx-5 px-5">
            <section class="px-5 py-5 pt-5 pb-5" style="background: white; border-radius: 50px;">
            <div class="justify-content-center">
    <h2 class="text-center mb-4">HELP CHATBOT</h2>
    <div id="chat-area">
        <div class="message-container">
            <div class="message bot mb-4">
                <div class="message-content">
                    Hi! How can I assist you today?
                </div>
                <div class="message-timestamp">
                    09:00 AM
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
   
        <select class="form-control mb-3" id="problemSelect">
            <option value="problem1">How to report corruption</option>
            <option value="problem2">How to budget money</option>
            <option value="problem3">How to spend money </option>
            <option value="problem4">How should write my corruption report</option>
        </select>
             <label for="problemSelect">How select issue you may be experiencing:</label>
    </div>
    <input class="btn text-white px-2 form-control" type="submit" id="solveBtn" name="Answer" value="Answer" style="background-color: #007bff; border-radius: 20px;">
</div>
</section>
</div>
</div>

<script>
    const chatArea = document.getElementById('chat-area');
    const problemSelect = document.getElementById('problemSelect');
    const solveBtn = document.getElementById('solveBtn');

    function updateTime() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = now.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            const minutesStr = minutes < 10 ? '0' + minutes : minutes;
            const currentTime = hours + ':' + minutesStr + ' ' + ampm;

            document.querySelector('.message-timestamp').textContent = currentTime;
        }

        updateTime();

    solveBtn.addEventListener('click', function() {
        const selectedProblem = problemSelect.value;
        let response;
        
        switch (selectedProblem) {
            case 'problem1':
                response = "If you have evidence a corrupt act may have taken place, the next step will usually be to report the corrupt act to an authority that can investigate and take action against the wrongdoer";
                break;
            case 'problem2':
                response = "Calculate your net income,Track your spending,Set realistic goals,Make a plan ,Adjust your spending to stay on budget ,Review your budget regularly.";
                break;
            case 'problem3':
                response = "Create a budget: Track your spending and income to understand your financial situation.Prioritize your spending: Focus on needs over wants.Avoid impulse purchases.Take advantage of sales and discounts.Live below your means.Invest your money";
                break;
            case 'problem4':
                response = "Describe the act or decision which was brought about by corruption. Explain the role of the wrongdoer.   Provide information about your relationship with the wrongdoer and summarise any dealings that you had with them.   State the reasons why you consider the act or decision was motivated by corruption.Identify the evidence that supports your claim throughout the document. Explain what would have happened if the corruption had not taken place. Explain what action you want the body receiving your report to take.";
                break;
            default:
                response = "Please select a problem.";
        }

        displayMessage(response, 'bot');
    });

    function displayMessage(message, sender) {
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('message-container');

        const messageElement = document.createElement('div');
        messageElement.classList.add('message', sender);
        messageElement.innerHTML = `
            <div class="message-content">
                ${message}
            </div>
            <div class="message-timestamp">
                ${getCurrentTime()}
            </div>
        `;

        messageContainer.appendChild(messageElement);
        chatArea.appendChild(messageContainer);
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    function getCurrentTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    }
</script>
</body>
</html>