<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="image/logo.png" type="image/icon type">

<style>
/* Font */
@font-face { 
    font-family: groveFont; 
    src: url('groveFont.ttf'); 
}
html, body {
    height: 100%;               
    margin: 0;
    padding: 0;
}
body {
    margin: 0;
    font-family: "groveFont", sans-serif;
    font-weight: bold;
    text-transform: uppercase;
    overflow-x: hidden;
    background-image: url("img/background.png"); /* fixed syntax */
    background-size: cover;     /* optional: cover the navbar area */
    background-position: center; /* optional: center the image */
        background-repeat: no-repeat; /* Prevent tiling */


}

/* ------------------- Logo ------------------- */
.logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0;
}

.logo-container a {
    text-decoration: none;
    font-size: 24px;
    color: #181414;
}

/* ------------------- Navbar ------------------- */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
    padding: 10px 20px;
    position: relative;
}

.navbar a {
    text-decoration: none;
    color: #181414;
    padding: 8px 15px;
    transition: all 0.3s ease;
}

.navbar a:hover {
    color: green;
}

/* Hamburger */
.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.hamburger div {
    width: 25px;
    height: 3px;
    background-color: #181414;
    margin: 4px 0;
    transition: all 0.3s ease;
}

/* Mobile menu */
@media (max-width: 768px) {
    .navbar a {
        display: none;
    }
    .hamburger {
        display: flex;
    }
    .navbar.active a {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        border-top: 1px solid #ddd;
    }
    .navbar.active {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* ------------------- Chatbot ------------------- */
/* Chatbot Button */
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

/* Logo inside button */
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

/* Chatbot Modal */
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

.chatbot-content {
    padding: 10px;
}

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
</head>

<body>
<!-- Logo -->
<div class="logo-container">
    <a href="userIndex.php">ABC</a>
</div>

<!-- Navbar -->
<nav class="navbar" id="navbar">
    <a href="Complaint.php" class="contact-btn">File a Complaint</a>



    <!-- Hamburger -->
    <div class="hamburger" id="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</nav>

<!-- Chatbot Button -->
<button id="chatbotBtn" class="chatbot-btn">
    <img src="img/logo.png" alt="Chatbot" class="chatbot-logo">
</button>

<!-- Chatbot Modal -->
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

<script>
// ------------------- Mobile Navbar Toggle -------------------
const hamburger = document.getElementById('hamburger');
const navbar = document.getElementById('navbar');
hamburger.addEventListener('click', () => {
    navbar.classList.toggle('active');
});

// ------------------- Chatbot -------------------
const chatbotBtn = document.getElementById('chatbotBtn');
const chatbotModal = document.getElementById('chatbotModal');
const closeChat = document.getElementById('closeChat');

chatbotBtn.onclick = () => {
    chatbotModal.style.display = 'block';
}

closeChat.onclick = () => {
    chatbotModal.style.display = 'none';
}

// Dummy send message
const sendMessage = document.getElementById('sendMessage');
const userMessage = document.getElementById('userMessage');
const chatArea = document.querySelector('.chat-area');

sendMessage.onclick = () => {
    if(userMessage.value.trim() !== '') {
        const msg = document.createElement('p');
        msg.innerHTML = `<strong>You:</strong> ${userMessage.value}`;
        chatArea.appendChild(msg);

        const botMsg = document.createElement('p');
        botMsg.innerHTML = `<strong>Bot:</strong> Thank you! Our agent will respond shortly.`;
        chatArea.appendChild(botMsg);

        chatArea.scrollTop = chatArea.scrollHeight;
        userMessage.value = '';
    }
}
</script>
</body>
</html>
