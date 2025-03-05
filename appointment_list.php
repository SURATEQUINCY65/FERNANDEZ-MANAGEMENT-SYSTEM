<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .modal {
            display: flex;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center"> 
            <a class="text-2xl font-bold text-gray-800" href="#">Appointment Dashboard</a>
            <div class="space-x-4">
                <a class="text-gray-600 hover:text-gray-800" href="costumer.php">Customer List</a>
                <a class="text-gray-600 hover:text-gray-800" href="admin.php">Inventory Stocks</a>
                <a class="text-gray-600 hover:text-gray-800" href="#" id="cartLink">Appointment Dashboard</a>
                <a class="text-gray-600 hover:text-gray-800" href="#">Medical Record</a>
            </div>
        </div>
    </nav>

   <!-- Replace the existing search bar section with this -->
<div class="container mx-auto px-4 py-6">
    <div class="flex gap-4 mb-4">
        <div class="flex-1">
            <input type="text" 
                   id="searchInput" 
                   placeholder="Search notifications..." 
                   class="border border-gray-300 rounded px-4 py-2 w-full" 
                   oninput="filterNotifications()">
        </div>
        <div class="relative">
            <select id="dateFilter" 
                    class="border border-gray-300 rounded px-4 py-2 appearance-none bg-white pr-8"
                    onchange="filterByDate(this.value)">
                <option value="all">All Dates</option>
                <option value="today">Today</option>
                <option value="tomorrow">Tomorrow</option>
                <option value="month">This Month</option>
            </select>
            <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <i class="fas fa-chevron-down text-gray-400"></i>
            </div>
        </div>
    </div>
    <ul id="notificationList" class="list-disc pl-5">
        <!-- Notifications will be populated here -->
    </ul>
</div>
<script>
// Add these functions to your existing script section

// Function to filter notifications by date
function filterByDate(filterValue) {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    const weekEnd = new Date(today);
    weekEnd.setDate(today.getDate() + 7);
    
    const monthEnd = new Date(today);
    monthEnd.setMonth(today.getMonth() + 1);

    const filteredNotifications = notifications.filter(notification => {
        const appointmentDate = extractDateFromNotification(notification.message);
        if (!appointmentDate) return false;

        switch (filterValue) {
            case 'last week':
                return isSameDay(appointmentDate, today);
            case 'tomorrow':
                return isSameDay(appointmentDate, tomorrow);
            case 'today':
                return appointmentDate >= today && appointmentDate < weekEnd;
            case 'month':
        }
    });

    updateNotificationList(filteredNotifications);
}

// Helper function to extract date from notification message
function extractDateFromNotification(message) {
    // Assuming the date format in the message is YYYY-MM-DD
    const dateMatch = message.match(/\d{4}-\d{2}-\d{2}/);
    return dateMatch ? new Date(dateMatch[0]) : null;
}

// Helper function to check if two dates are the same day
function isSameDay(date1, date2) {
    return date1.getFullYear() === date2.getFullYear() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getDate() === date2.getDate();
}

// Update the existing filterNotifications function
function filterNotifications() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const dateFilter = document.getElementById('dateFilter').value;
    
    let filteredNotifications = notifications;
    
    // First apply date filter
    if (dateFilter !== 'all') {
        filteredNotifications = filterByDate(dateFilter);
    }
    
    // Then apply search filter
    filteredNotifications = filteredNotifications.filter(notification => 
        notification.message.toLowerCase().includes(searchInput)
    );
    
    updateNotificationList(filteredNotifications);
}

// Update the existing updateNotificationList function to show grouped notifications
function updateNotificationList(filteredNotifications = notifications) {
    notificationList.innerHTML = '';
    
    // Group notifications by date
    const groupedNotifications = groupNotificationsByDate(filteredNotifications);
    
    // Create sections for each date
    Object.entries(groupedNotifications).forEach(([date, notifications]) => {
        const dateSection = document.createElement('div');
        dateSection.className = 'mb-6';
        
        const dateHeader = document.createElement('h3');
        dateHeader.className = 'text-lg font-semibold mb-2 text-gray-700';
        dateHeader.textContent = formatDate(date);
        dateSection.appendChild(dateHeader);
        
        const notificationGroup = document.createElement('ul');
        notificationGroup.className = 'space-y-2';
        
        notifications.forEach((notification, index) => {
            // ... existing notification item creation code ...
        });
        
        dateSection.appendChild(notificationGroup);
        notificationList.appendChild(dateSection);
    });
}

// Helper function to group notifications by date
function groupNotificationsByDate(notifications) {
    return notifications.reduce((groups, notification) => {
        const date = extractDateFromNotification(notification.message)?.toISOString().split('T')[0] || 'No Date';
        if (!groups[date]) {
            groups[date] = [];
        }
        groups[date].push(notification);
        return groups;
    }, {});
}

// Helper function to format date for display
function formatDate(dateString) {
    if (dateString === 'No Date') return dateString;
    
    const date = new Date(dateString);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    if (isSameDay(date, today)) {
        return 'Today';
    } else if (isSameDay(date, tomorrow)) {
        return 'Tomorrow';
    } else {
        return date.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    }
}
</script>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal hidden">
        <div class="modal-content text-center">
            <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
            <p class="text-lg">Appointment confirmation successful!</p>
            <button id="closeModal" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Close</button>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div id="rescheduleModal" class="modal hidden">
        <div class="modal-content text-center">
            <i class="fas fa-calendar-alt text-yellow-500 text-4xl mb-4"></i>
            <p class="text-lg">Select a new date for the appointment:</p>
            <input type="date" id="newDateInput" class="border border-gray-300 rounded px-4 py-2 mb-4">
            <div>
                <button id="confirmReschedule" class="bg-yellow-500 text-white px-4 py-2 rounded mt-4">Confirm Reschedule</button>
                <button id="closeRescheduleModal" class="bg-gray-500 text-white px-4 py-2 rounded mt-4">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p></p>
        </div>
    </footer>

    <script>
        // Load notifications from local storage
        const notifications = JSON.parse(localStorage.getItem('notifications')) || [];
        const notificationList = document.getElementById('notificationList');
        const confirmationModal = document.getElementById('confirmationModal');
        const rescheduleModal = document.getElementById('rescheduleModal');
        const closeModalButton = document.getElementById('closeModal');
        const closeRescheduleModalButton = document.getElementById('closeRescheduleModal');

        let currentNotificationIndex; // To keep track of which notification is being rescheduled

        // Function to update the notification list
        function updateNotificationList(filteredNotifications = notifications) {
            notificationList.innerHTML = ''; // Clear the list
            filteredNotifications.forEach((notification, index) => {
                const li = document.createElement('li');
                li.className = 'flex items-center justify-between mb-2';
                li.innerText = `${notification.message} (Received on: ${notification.date})`;
                
                // Create delete button
                const deleteButton = document.createElement('button');
                deleteButton.innerText = 'Delete';
                deleteButton.className = 'bg-red-500 text-white px-2 py-1 rounded';
                deleteButton.onclick = function() {
                    notifications.splice(index, 1); // Remove notification from array
                    localStorage.setItem('notifications', JSON.stringify(notifications)); // Update local storage
                    updateNotificationList(); // Refresh the list
                };

                // Create confirm button
                const confirmButton = document.createElement('button');
                confirmButton.innerText = 'Confirm';
                confirmButton.className = 'bg-green-500 text-white px-2 py-1 rounded ml-2';
                confirmButton.onclick = function() {
                    const confirmationNotification = {
                        message: `Appointment confirmed: ${notification.message}`,
                        date: new Date().toLocaleString()
                    };
                    notifications.splice(index, 1); // Remove the confirmed notification from the list
                    notifications.push(confirmationNotification);
                    localStorage.setItem('notifications', JSON.stringify(notifications)); // Update local storage
                    updateNotificationList(); // Refresh the list
                    showConfirmationModal(); // Show confirmation modal
                };

                // Create reschedule button
                const rescheduleButton = document.createElement('button');
                rescheduleButton.innerText = 'Reschedule';
                rescheduleButton.className = 'bg-yellow-500 text-white px-2 py-1 rounded ml-2';
                rescheduleButton.onclick = function() {
                    currentNotificationIndex = index; // Store the index of the notification being rescheduled
                    rescheduleModal.classList.remove('hidden'); // Show the reschedule modal

                    // Set the minimum date to today
                    const today = new Date().toISOString().split('T')[0];
                    document.getElementById('newDateInput').setAttribute('min', today);
                };

                li.appendChild(deleteButton);
                li.appendChild(confirmButton);
                li.appendChild(rescheduleButton);
                notificationList.appendChild(li);
            });
        }

        // Function to show confirmation modal
        function showConfirmationModal() {
            confirmationModal.classList.remove('hidden');
        }

        // Confirm reschedule button click event
        document.getElementById('confirmReschedule').onclick = function() {
            const newDate = document.getElementById('newDateInput').value;
            const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

            if (!newDate) {
                alert('Please select a new date.');
                return;
            }

            if (newDate < today) {
                alert('You cannot reschedule to a past date. Please select a future date.');
                return;
            }

            // Create a reschedule notification
            const rescheduleNotification = {
                message: `Appointment rescheduled to: ${newDate}`,
                date: new Date().toLocaleString()
            };
            
            notifications.splice(currentNotificationIndex, 1); // Remove the old notification
            notifications.push(rescheduleNotification); // Add the new rescheduled notification
            localStorage.setItem('notifications', JSON.stringify(notifications)); // Update local storage
            updateNotificationList(); // Refresh the list
            rescheduleModal.classList.add('hidden'); // Hide the modal
        };

        // Function to close confirmation modal
        closeModalButton.onclick = function() {
            confirmationModal.classList.add('hidden');
        };

        // Function to close reschedule modal
        closeRescheduleModalButton.onclick = function() {
            rescheduleModal.classList.add('hidden');
        };

        // Function to filter notifications based on search input
        function filterNotifications() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const filteredNotifications = notifications.filter(notification => 
                notification.message.toLowerCase().includes(searchInput)
            );
            updateNotificationList(filteredNotifications);
        }

        // Initial call to populate the notification list
        updateNotificationList();
    </script>
</body>
</html>