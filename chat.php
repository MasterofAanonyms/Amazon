<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon AI Chat App</title>
    <link rel="shortcut icon" href="resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
    background-color: #f8f9fa;
}

.chat-box {
    width: 100%;
    max-width: 600px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.chat-header {
    color: black;
    padding: 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    text-align: center;
}

.chat-body {
    height: 400px;
    overflow-y: scroll;
    padding: 15px;
    background-color: #ffffff;
}

.chat-footer {
    display: flex;
    padding: 15px;
    border-top: 1px solid #ddd;
}

.chat-footer input {
    flex-grow: 1;
    margin-right: 10px;
}

.chat-footer button {
    width: 100px;
}

.head{
    background-color: black;
}

.message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 10px;
    max-width: 80%;
}

.message.user {
    background-color: #f1f1f1;
    text-align: right;
    margin-left: auto;
}

.message.bot {
    background-color: #e1f5fe;
    text-align: left;
    margin-right: auto;
}

    </style>
</head>
<body>
    <div class="head">
    <?php include "header_main.php" ?>
    <br>
    </div>
    
    <div class="container">
        <div class="chat-box">
            <div class="chat-header bg-warning">
                <h5>Amazon Chat bot</h5>
            </div>
            <div class="chat-body" id="chat-body">
                <!-- Messages will be appended here -->
            </div>
            <div class="chat-footer">
                <input type="text" id="userInput" class="form-control" placeholder="Type a message...">
                <button class="btn btn-warning" id="sendBtn" onclick="sendMessage();">Send</button>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
