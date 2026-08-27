/*
const chatForm = document.querySelector('#chat-form');
const chatInput = document.querySelector('#chat-input');
const chatMessages = document.querySelector('.chat-messages');

// A function to create a new chat bubble element
function createChatBubble(text, sender) {
    const bubble = document.createElement('div');
    bubble.classList.add('chat-bubble');
    bubble.classList.add(sender === 'ai' ? 'ai-bubble' : 'user-bubble');
    bubble.textContent = text;
    return bubble;
}

// A function to add a new message to the chat log
function addMessage(text, sender) {
    const bubble = createChatBubble(text, sender);
    chatMessages.appendChild(bubble);
    // Scroll to the bottom of the chat log
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Handle the chat form submission
chatForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const message = chatInput.value.trim();
    if (!message) {
        return;
    }
    addMessage(message, 'user');
    chatInput.value = '';

    sendMessageToServer( message );
});


async function sendMessageToServer( message )
{
    // Send the message to the server
    const response = await fetch('chatbot.php', {
        method: 'POST',
        body: new URLSearchParams({
            message: message
        })
    });

    if (!response.ok) {
        console.error('Error fetching response from server');
        return;
    }

    // Parse the response JSON and add it to the chat log
    const data = await response.json();
    addMessage(data.message, 'ai');
}
*/

const chatForm = document.querySelector('#chat-form');
const chatInput = document.querySelector('#chat-input');
const chatMessages = document.querySelector('.chat-messages');

let lastUserMessageTime = new Date().getTime();

// A function to create a new chat bubble element
function createChatBubble(text, sender) {
  const bubble = document.createElement('div');
  bubble.classList.add('chat-bubble');
  bubble.classList.add(sender === 'ai' ? 'ai-bubble' : 'user-bubble');
  bubble.textContent = text;
  return bubble;
}

// A function to add a new message to the chat log
function addMessage(text, sender) {
  const bubble = createChatBubble(text, sender);
  chatMessages.appendChild(bubble);
  // Scroll to the bottom of the chat log
  chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Handle the chat form submission
chatForm.addEventListener('submit', async (event) => {
  event.preventDefault();
  const message = chatInput.value.trim();
  if (!message) {
    return;
  }
  addMessage(message, 'user');
  chatInput.value = '';

  sendMessageToServer(message);
  lastUserMessageTime = new Date().getTime();
});

async function sendMessageToServer(message) {
  // Send the message to the server
  const response = await fetch('chatbot.php', {
    method: 'POST',
    body: new URLSearchParams({
      message: message,
    }),
  });

  if (!response.ok) {
    console.error('Error fetching response from server');
    return;
  }

  // Parse the response JSON and add it to the chat log
  const data = await response.json();
  addMessage(data.message, 'ai');
}

// Check if it has been more than 5 minutes since the last user message
setInterval(() => {
  const currentTime = new Date().getTime();
  if (currentTime - lastUserMessageTime > 1 * 60 * 1000) {
    sendMessageToServer('---silence---');
    lastUserMessageTime = currentTime;
  }
}, 1000);
