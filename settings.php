<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Account Settings</h1>
                <a href="home.php" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                </a>
            </div>

            <!-- Settings Sections -->
            <div class="space-y-6">
                <!-- Account Security -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-semibold mb-4">Account Security</h2>
                    <div class="space-y-4">
                        <button class="flex items-center text-gray-700 hover:text-blue-500">
                            <i class="fas fa-key mr-3"></i>
                            Change Password
                        </button>
                        <button class="flex items-center text-gray-700 hover:text-blue-500">
                            <i class="fas fa-shield-alt mr-3"></i>
                            Two-Factor Authentication
                        </button>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-semibold mb-4">Notifications</h2>
                    <div class="space-y-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500" id="emailNotif">
                            <span class="ml-3">Email Notifications</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500" id="appointmentReminder">
                            <span class="ml-3">Appointment Reminders</span>
                        </label>
                    </div>
                </div>

                <!-- Privacy -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-semibold mb-4">Privacy</h2>
                    <div class="space-y-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500" id="profileVisibility">
                            <span class="ml-3">Profile Visibility</span>
                        </label>
                    </div>
                </div>

                <!-- Save Changes Button -->
                <div class="flex justify-end pt-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="saveSettings()">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load saved settings
        document.addEventListener('DOMContentLoaded', function() {
            const savedSettings = JSON.parse(localStorage.getItem('userSettings')) || {};
            
            document.getElementById('emailNotif').checked = savedSettings.emailNotif || false;
            document.getElementById('appointmentReminder').checked = savedSettings.appointmentReminder || false;
            document.getElementById('profileVisibility').checked = savedSettings.profileVisibility || false;
        });

        // Save settings
        function saveSettings() {
            const settings = {
                emailNotif: document.getElementById('emailNotif').checked,
                appointmentReminder: document.getElementById('appointmentReminder').checked,
                profileVisibility: document.getElementById('profileVisibility').checked
            };
            
            localStorage.setItem('userSettings', JSON.stringify(settings));
            alert('Settings saved successfully!');
        }
    </script>
</body>
</html>
