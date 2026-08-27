<?php
// Retrieve the message from the POST request
$message = $_POST['message'];

// Example: Send message to a chatbot service (replace with your actual implementation)
$response = sendMessageToChatbot($message);

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['message' => $response]);

// Function to send message to a chatbot service (example)
function sendMessageToChatbot($message) {
    // Replace with your logic to send message to a chatbot service (e.g., Dialogflow)
    // Here's a simple example:
    return 'This is a response from the chatbot for message: ' . $message;
}
?>
<script>
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
</script>
