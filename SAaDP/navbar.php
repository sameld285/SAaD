<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="icon" href="image/icon.png" type="image/icon type">
    <script defer src="script.js"></script>
</head>
<body>

    <div id="sidebar" class="sidebar">
        <button id="closeSidebar" class="close-btn">&times;</button>
        <nav>
            <a href="index.php">Home</a>
            <a href="signup.php">Signup</a>
            <a href="login.php">Login</a>
            <a href="admin.php">Admin</a>
            <!-- <div class="dropdown">
                <a href="services.php">Services</a>
                <div class="dropdown-content">
                </div>
            </div> -->
        </nav>
    </div>

    <div id="overlay" class="overlay"></div>

    <nav class="navbar">
        <button id="menuButton" class="menu-btn">&#9776;</button>

        <div class="logo-container">
            <img src="img/logo.png" alt="Logo" class="logo">
            <a href="index.php">
            <h1 class="mobile-hide" style="color:black">ABC COMPLAINTS</h1>

            </a>
        </div>

        <a href="contact.php" class="contact-btn">Contact</a>
    </nav>

    <button id="chatbotBtn" class="chatbot-btn">
        <img src="img/logo.png" alt="Chatbot" class="chatbot-logo">
    </button>

    <div id="chatbotModal" class="chatbot-modal">
        <div class="chatbot-content">
            <span id="closeChat" class="close">&times;</span>
            <h3>Chatbot (POC)</h3>
            <div class="chat-area">
                <p><strong>Bot:</strong> Hello! How can I help you today?</p>
            </div>
            <input type="text" id="userMessage" placeholder="Type a message..." />
            <button id="sendMessage">Send</button>
        </div>
    </div>

<style>
.chatbot-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 1000;
    padding: 0;
}

.chatbot-logo {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    transition: transform 0.2s ease;
}

.chatbot-btn:hover .chatbot-logo {
    transform: scale(1.1);
}

.chatbot-modal {
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 300px;
    background: white;
    border: 2px solid #181414;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    z-index: 1000;
}

.chatbot-content { padding: 10px; }

.chat-area {
    height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    padding: 5px;
}

.close {
    float: right;
    cursor: pointer;
    font-weight: bold;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const menuButton = document.getElementById("menuButton");
    const closeSidebar = document.getElementById("closeSidebar");

    menuButton.addEventListener("click", () => {
        sidebar.style.left = "0";
        overlay.style.display = "block";
    });

    closeSidebar.addEventListener("click", () => {
        sidebar.style.left = "-250px";
        overlay.style.display = "none";
    });

    overlay.addEventListener("click", () => {
        sidebar.style.left = "-250px";
        overlay.style.display = "none";
    });

    const chatbotBtn = document.getElementById("chatbotBtn");
    const chatbotModal = document.getElementById("chatbotModal");
    const closeChat = document.getElementById("closeChat");
    const sendMessage = document.getElementById("sendMessage");
    const userMessage = document.getElementById("userMessage");
    const chatArea = document.querySelector(".chat-area");

    chatbotBtn.onclick = () => {
        chatbotModal.style.display = "block";
    };

    closeChat.onclick = () => {
        chatbotModal.style.display = "none";
    };

    sendMessage.onclick = () => {
        let text = userMessage.value.trim();
        if(text !== "") {
            chatArea.innerHTML += `<p><strong>You:</strong> ${text}</p>`;
            chatArea.innerHTML += `<p><strong>Bot:</strong> Thank you! Our agent will respond shortly.</p>`;
            chatArea.scrollTop = chatArea.scrollHeight;
            userMessage.value = "";
        }
    };
});
</script>

</body>
</html>
