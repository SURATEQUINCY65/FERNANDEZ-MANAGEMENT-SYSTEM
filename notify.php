<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        /* Custom Styles for Notifications Section */
        body {
            font-family: 'Roboto', sans-serif; /* Ensure the font is consistent */
            background-color: #f9fafb; /* Light background color */
            color: #333; /* Dark text color */
            margin: 0;
            padding: 0;
        }

        button {
            transition: background-color 0.3s ease; /* Smooth transition for button hover */
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            color: white; /* White text on hover */
        }

        .bg-blue-500 {
            background-color: #3b82f6; /* Blue background */
            color: white; /* White text */
        }

        .bg-yellow-500 {
            background-color: #f59e0b; /* Yellow background */
            color: white; /* White text */
        }

        .bg-green-500 {
            background-color: #22c55e; /* Green background */
            color: white; /* White text */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }

        th, td {
            border: 1px solid #e2e8f0; /* Light gray border */
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #edf2f7; /* Light gray background for header */
            color: #4a5568; /* Dark gray text */
            font-weight: bold; /* Bold text for header */
        }

        tr:hover {
            background-color: #f7fafc; /* Light gray background on hover */
            cursor: pointer; /* Change cursor to pointer */
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto; /* Center the modal */
            padding: 20px;
            border: 1px solid #ccc;
            width: 400px; /* Set a fixed width for the modal */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: left; /* Align text to the left */
        }

        .close-notification, .close-reschedule {
            cursor: pointer;
            float: right;
            font-size: 20px;
            color: #aaa; /* Light gray color for close button */
        }

        .close-notification:hover, .close-reschedule:hover {
            color: #000; /* Darker color on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            th, td {
                padding: 8px; /* Smaller padding on mobile */
            }

            .modal-content {
                width: 90%; /* Full width on mobile */
            }
        }
    </style>
</head>
<body>

<!-- Notifications Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4">
        <button onclick="history.back()" class="bg-blue-500 mb-4">Go Back</button>
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Notifications</h2>
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Message</th>
                    <th class="py-3 px-6 text-left">Date</th>
                </tr>
            </thead>
            <tbody id="notificationList" class="text-gray-600 text-sm font-light">
                <!-- Notifications will be populated here -->
            </tbody>
        </table>
    </div>
</section>

<!-- Modal Structure for Notification Details -->
<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span class="close-notification">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Appointment Details</h2>
        <p id="notificationMessage"></p>
        <p id="notificationDate"></p>
        <button id="rescheduleButton" class="bg-yellow-500 mt-4">Reschedule</button>
    </div>
</div>

<!-- Update the reschedule modal -->
<div id="rescheduleModal" class="modal">
    <div class="modal-content">
        <span class="close-reschedule">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Reschedule Appointment</h2>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="newDate">New Date:</label>
            <input type="date" id="newDate" class="w-full px-4 py-2 border rounded mb-4">
            
            <label class="block text-gray-700 mb-2" for="newTime">New Time:</label>
            <select id="newTime" class="w-full px-4 py-2 border rounded mb-4">
                <option value="">Select a time</option>
                <option value="10:30">10:30 AM</option>
                <option value="10:45">10:45 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="11:20">11:20 AM</option>
                <option value="13:30">1:30 PM</option>
                <option value="14:00">2:00 PM</option>
                <option value="15:00">3:00 PM</option>
                <option value="16:00">4:00 PM</option>
            </select>
            
            <div class="flex justify-end space-x-2">
                <button id="confirmReschedule" class="bg-green-500 text-white px-4 py-2 rounded">
                    Confirm
                </button>
                <button onclick="closeRescheduleModal()" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal for Rescheduling -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <h2 class="text-2xl font-bold mb-4">Confirm Reschedule</h2>
        <p>Are you sure you want to reschedule this appointment?</p>
        <button id="confirmYes" class="bg-green-500 mt-4">Yes</button>
        <button id="confirmNo" class="bg-red-500 mt-4">No</button>
    </div>
</div>


<script>
// Get current logged-in user from localStorage
function getCurrentUser() {
    return JSON.parse(localStorage.getItem('currentUser')) || null;
}

// Filter notifications by user
function getUserNotifications() {
    const currentUser = getCurrentUser();
    if (!currentUser) return [];

    const allNotifications = JSON.parse(localStorage.getItem('notifications')) || [];
    return allNotifications.filter(notification => {
        // Check if notification belongs to current user
        return notification.userId === currentUser.id || 
               (notification.message && notification.message.includes(currentUser.username));
    });
}

// Update the updateNotificationList function
function updateNotificationList() {
    const notificationList = document.getElementById('notificationList');
    notificationList.innerHTML = ''; // Clear the list
    
    const userNotifications = getUserNotifications();
    
    if (userNotifications.length === 0) {
        // Show message if no notifications
        const row = document.createElement('tr');
        const cell = document.createElement('td');
        cell.colSpan = 2;
        cell.innerText = 'No appointments or notifications found.';
        cell.className = 'text-center py-4';
        row.appendChild(cell);
        notificationList.appendChild(row);
        return;
    }

    userNotifications.forEach((notification) => {
        const row = document.createElement('tr');
        row.addEventListener('click', () => showNotificationDetails(notification));
        
        const messageCell = document.createElement('td');
        messageCell.innerText = notification.message;
        row.appendChild(messageCell);
        
        const dateCell = document.createElement('td');
        dateCell.innerText = notification.date;
        row.appendChild(dateCell);
        
        notificationList.appendChild(row);
    });
}

// Update the handleReschedule function
function handleReschedule() {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        alert('Please log in to reschedule appointments.');
        return;
    }

    const newDate = document.getElementById('newDate').value;
    const newTime = document.getElementById('newTime').value;
    
    if (!newDate || !newTime) {
        alert('Please select both date and time');
        return;
    }

    // Get the current appointment from the notification
    const appointmentDetails = currentNotification.message.match(/scheduled for (.*?) on (.*?) at (.*?)\./);
    if (!appointmentDetails) {
        alert('Error processing appointment details');
        return;
    }

    const [_, name, oldDate, oldTime] = appointmentDetails;

    // Update appointments list
    const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
    const appointmentIndex = appointments.findIndex(apt => 
        apt.date === oldDate && 
        apt.time === oldTime && 
        apt.userId === currentUser.id // Add user check
    );

    if (appointmentIndex !== -1) {
        // Update the appointment
        appointments[appointmentIndex].date = newDate;
        appointments[appointmentIndex].time = newTime;
        localStorage.setItem('appointments', JSON.stringify(appointments));

        // Create new notification for rescheduled appointment
        const newNotification = {
            message: `Appointment rescheduled: ${name} from ${oldDate} ${oldTime} to ${newDate} ${newTime}`,
            date: new Date().toLocaleString(),
            type: 'reschedule',
            userId: currentUser.id // Add user ID to notification
        };

        // Update notifications
        const notifications = JSON.parse(localStorage.getItem('notifications')) || [];
        notifications.push(newNotification);
        localStorage.setItem('notifications', JSON.stringify(notifications));

        // Close modal and update display
        closeRescheduleModal();
        updateNotificationList();
        alert('Appointment successfully rescheduled!');
    }
}

// Add event listener for page load
document.addEventListener('DOMContentLoaded', function() {
    const currentUser = getCurrentUser();
    if (!currentUser) {
        // If no user is logged in, show message
        const notificationList = document.getElementById('notificationList');
        notificationList.innerHTML = `
            <tr>
                <td colspan="2" class="text-center py-4">
                    Please log in to view your appointments and notifications.
                </td>
            </tr>
        `;
        return;
    }

    // Initialize notifications with user-specific data
    updateNotificationList();
});

// Update existing event listeners
const closeButtons = document.querySelectorAll('.close-notification, .close-reschedule');
closeButtons.forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
    });
});
</script>

<script>
    document.getElementById('rescheduleButton').addEventListener('click', function() {
        document.getElementById('notificationModal').style.display = 'none';
        document.getElementById('confirmationModal').style.display = 'block';
    });

    document.getElementById('confirmYes').addEventListener('click', function() {
        document.getElementById('confirmationModal').style.display = 'none';
        document.getElementById('rescheduleModal').style.display = 'block';
    });

    document.getElementById('confirmNo').addEventListener('click', function() {
        document.getElementById('confirmationModal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        const confirmationModal = document.getElementById('confirmationModal');
        if (event.target === confirmationModal) {
            confirmationModal.style.display = 'none';
        }
    });
</script>

<script>
    // Load notifications from local storage
    const notifications = JSON.parse(localStorage.getItem('notifications')) || [];
    const notificationList = document.getElementById('notificationList');
    let currentNotification = null; // To store the currently selected notification

    // Function to update the notification list
    function updateNotificationList() {
        notificationList.innerHTML = ''; // Clear the list
        notifications.forEach((notification) => {
            const row = document.createElement('tr');
            row.addEventListener('click', () => showNotificationDetails(notification)); // Add click event
            
            const messageCell = document.createElement('td');
            messageCell.innerText = notification.message;
            row.appendChild(messageCell);
            
            const dateCell = document.createElement('td');
            dateCell.innerText = notification.date;
            row.appendChild(dateCell);
            
            notificationList.appendChild(row);
        });
    }

    // Function to show notification details in a modal
    function showNotificationDetails(notification) {
        currentNotification = notification; // Store the current notification
        document.getElementById('notificationMessage').innerText = notification.message;
        document.getElementById('notificationDate').innerText = notification.date;
        document.getElementById('notificationModal').style.display = 'block'; // Show modal

        // Only show reschedule button for appointment notifications
        const rescheduleButton = document.getElementById('rescheduleButton');
        rescheduleButton.style.display = notification.message.includes('appointment') ? 'block' : 'none';
    }

    // Close modal when clicking the close button
    document.querySelector('.close-notification').addEventListener('click', function() {
        document.getElementById('notificationModal').style.display = 'none'; // Hide modal
    });

    // Open reschedule modal
    document.getElementById('rescheduleButton').addEventListener('click', function() {
        document.getElementById('notificationModal').style.display = 'none'; // Hide notification modal
        document.getElementById('rescheduleModal').style.display = 'block'; // Show reschedule modal
    });

    // Close reschedule modal when clicking the close button
    document.querySelector('.close-reschedule').addEventListener('click', function() {
        document.getElementById('rescheduleModal').style.display = 'none'; // Hide reschedule modal
    });

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
        }

    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        const notificationModal = document.getElementById('notificationModal');
        const rescheduleModal = document.getElementById('rescheduleModal');
        if (event.target === notificationModal) {
            notificationModal.style.display = 'none'; // Hide notification modal
        }
        if (event.target === rescheduleModal) {
            rescheduleModal.style.display = 'none'; // Hide reschedule modal
        }
    });

    // Add these new functions to handle rescheduling
    function handleReschedule() {
        const newDate = document.getElementById('newDate').value;
        const newTime = document.getElementById('newTime').value;
        
        if (!newDate || !newTime) {
            alert('Please select both date and time');
            return;
        }

        // Get the current appointment from the notification
        const appointmentDetails = currentNotification.message.match(/scheduled for (.*?) on (.*?) at (.*?)\./);
        if (!appointmentDetails) {
            alert('Error processing appointment details');
            return;
        }

        const [_, name, oldDate, oldTime] = appointmentDetails;

        // Update appointments list
        const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
        const appointmentIndex = appointments.findIndex(apt => 
            apt.date === oldDate && 
            apt.time === oldTime
        );

        if (appointmentIndex !== -1) {
            // Update the appointment
            appointments[appointmentIndex].date = newDate;
            appointments[appointmentIndex].time = newTime;
            localStorage.setItem('appointments', JSON.stringify(appointments));

            // Create new notification for rescheduled appointment
            const newNotification = {
                 message: "Appointment details...",
                date: new Date().toLocaleString(),
                 userId: currentUser.id,
                type: "appointment"
          };

            // Update notifications
            notifications.push(newNotification);
            localStorage.setItem('notifications', JSON.stringify(notifications));

            // Close modal and update display
            closeRescheduleModal();
            updateNotificationList();
            alert('Appointment successfully rescheduled!');
        }
    }

    function closeRescheduleModal() {
        document.getElementById('rescheduleModal').style.display = 'none';
        document.getElementById('confirmationModal').style.display = 'none';
    }

    // Update the existing event listeners
    document.getElementById('confirmReschedule').addEventListener('click', handleReschedule);

    // Add validation for the date input
    document.getElementById('newDate').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            alert('Cannot select a past date');
            this.value = '';
            return;
        }

        if (selectedDate.getDay() === 0) {
            alert('Appointments are not available on Sundays');
            this.value = '';
            return;
        }
    });

    // Initial call to populate the notification list
    updateNotificationList();
</script>
</body>
</html>