<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/webp" href="Images/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Family Chat Spot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightskyblue;
        }
        .container {
            max-width: 800px;
            height: 600px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        #messages {
            border: 1px solid #ccc;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
        }
        #message {
            width: calc(100% - 80px);
            padding: 8px;
            font-size: 16px;
        }
        #send {
            width: 70px;
            height: 38px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }
        .delete-btn {
            color: #fff;
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            margin-left: 5px;
            cursor: pointer;
            font-size: 12px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Family Chat Spot</h2>
        <div id="messages"></div>
        <div>
            <input type="text" id="message" placeholder="Type your message...">
            <button id="send">Send</button>
        </div>
    </div>
    <script>
        const messagesContainer = document.getElementById('messages');
        const messageInput = document.getElementById('message');
        const sendButton = document.getElementById('send');

        // Simulated user IDs for demo purposes
        const senderId = 1; // Assume logged in user ID is 1
        const receiverId = 2; // Assume chatting with user ID 2

        sendButton.addEventListener('click', function() {
            const messageText = messageInput.value.trim();
            if (messageText !== '') {
                sendMessage(senderId, receiverId, messageText);
                messageInput.value = '';
            }
        });

        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendButton.click();
            }
        });

        function sendMessage(sender_id, receiver_id, message) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    fetchMessages();
                }
            };
            xhr.send(`sender_id=${encodeURIComponent(sender_id)}&receiver_id=${encodeURIComponent(receiver_id)}&message=${encodeURIComponent(message)}`);
        }

        function fetchMessages() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `fetch_messages.php?user_id=${encodeURIComponent(senderId)}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const messages = JSON.parse(xhr.responseText);
                    messagesContainer.innerHTML = '';
                    messages.forEach(function(message) {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('message');
                        messageElement.innerHTML = `<span class="username">${message.sender} to ${message.receiver}:</span> <span class="text">${message.message}</span> <span class="timestamp">${new Date(message.timestamp).toLocaleTimeString()}</span>`;
                        
                        // Delete button for each message
                        const deleteButton = document.createElement('button');
                        deleteButton.classList.add('delete-btn');
                        deleteButton.textContent = 'Delete';
                        deleteButton.onclick = function() {
                            deleteMessage(message.messageID);
                            messageElement.remove();
                        };
                        messageElement.appendChild(deleteButton);

                        messagesContainer.appendChild(messageElement);
                    });
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            };
            xhr.send();
        }

        function deleteMessage(id) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`id=${encodeURIComponent(id)}`);
        }

        // Initial fetch
        fetchMessages();
        // Refresh messages every 5 seconds
        setInterval(fetchMessages, 5000);
    </script>
</body>
</html>
