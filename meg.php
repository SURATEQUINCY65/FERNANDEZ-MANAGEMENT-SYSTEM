<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Message Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center"> 
           
            </div>
        </div>
    </nav>
    <!-- Message Notifications Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Message Notifications</h2>
            <div class="bg-white p-6 rounded shadow-md">
                <form id="messageForm" onsubmit="sendMessage(event)">
                    <input type="text" id="messageInput" placeholder="Type a message..." required class="border p-2 rounded w-full mb-4"/>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send Message</button>
                </form>
                </div>
            </div>
            <script>
                // Load messages from local storage
                const messages = JSON.parse(localStorage.getItem('messages')) || [];
                const messageList = document.getElementById('messageList');

                function renderMessages() {
                    messageList.innerHTML = ''; // Clear existing messages
                    messages.forEach((message, index) => {
                        const messageElement = document.createElement('div');
                        messageElement.className = 'border p-4 mb-2 rounded bg-gray-50';
                        messageElement.innerHTML = `
                            <p><strong>Message ${index + 1}:</strong> ${message}</p>
                            <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteMessage(${index})">Delete</button>
                        `;
                        messageList.appendChild(messageElement);
                    });
                }

                // Send message
                function sendMessage(event) {
                    event.preventDefault(); // Prevent the default form submission
                    const input = document.getElementById('messageInput');
                    const message = input.value.trim();
                    if (message) {
                        messages.push(message); // Add message to the array
                        localStorage.setItem('messages', JSON.stringify(messages)); // Update local storage
                        input.value = ''; // Clear the input
                        renderMessages(); // Re-render the messages
                    }
                }

                // Delete message
                function deleteMessage(index) {
                    messages.splice(index, 1); // Remove the message from the array
                    localStorage.setItem('messages', JSON.stringify(messages)); // Update local storage
                    renderMessages(); // Re-render the messages
                }

                // Initial render
                renderMessages();
            </script>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
 <div class="container mx-auto px-4 text-center">
            <p></p>
        </div>
    </footer>
</body>
</html>