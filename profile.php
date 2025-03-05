<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="text-center mb-8">
                <img src="https://cdn.vectorstock.com/i/1000v/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.jpg" 
                     alt="Avatar" 
                     style="width:90px" 
                     class="cursor-pointer rounded-full" 
                     onclick="toggleMobileMenu()" 
                     id="profilePreview">

                <input type="file" 
                       id="profileImageInput" 
                       accept="image/*" 
                       class="hidden" 
                       onchange="updateProfileImage(event)">

                <div class="flex justify-center items-center gap-2">
                    <label class="cursor-pointer text-blue-500 hover:text-blue-700" for="profileImageInput">
                        <i class="fas fa-camera mr-2"></i>Change Photo
                    </label>
                    <button onclick="removeProfilePhoto()" 
                            class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash mr-2"></i>Remove
                    </button>
                </div>
            </div>

            <form id="profile-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">Address</label>
                    <textarea id="address" name="address" rows="3" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Save Changes
                    </button>
                    <a href="home.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Back to Home
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Function to update profile image
    function updateProfileImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageUrl = e.target.result;
                
                // Update preview
                document.getElementById('profilePreview').src = imageUrl;
                
                // Update user data
                const userData = JSON.parse(localStorage.getItem('loggedInUser'));
                const users = JSON.parse(localStorage.getItem('users'));
                
                userData.profileImage = imageUrl;
                
                // Update in users array
                const userIndex = users.findIndex(u => u.username === userData.username);
                if (userIndex !== -1) {
                    users[userIndex].profileImage = imageUrl;
                    localStorage.setItem('users', JSON.stringify(users));
                }
                
                // Update logged in user
                localStorage.setItem('loggedInUser', JSON.stringify(userData));
                
                // Broadcast change event
                window.dispatchEvent(new CustomEvent('profileImageUpdated', { 
                    detail: { image: imageUrl } 
                }));
            };
            reader.readAsDataURL(file);
        }
    }

    // Function to save profile data
    function saveProfileData(e) {
        e.preventDefault();
        
        const userData = JSON.parse(localStorage.getItem('loggedInUser'));
        const users = JSON.parse(localStorage.getItem('users'));
        
        // Update user data
        const updatedData = {
            ...userData,
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value
        };
        
        // Update in users array
        const userIndex = users.findIndex(u => u.username === userData.username);
        if (userIndex !== -1) {
            users[userIndex] = updatedData;
            localStorage.setItem('users', JSON.stringify(users));
        }
        
        // Update logged in user data
        localStorage.setItem('loggedInUser', JSON.stringify(updatedData));
        
        alert('Profile updated successfully!');
        
        // Broadcast change event
        window.dispatchEvent(new CustomEvent('userDataUpdated', { 
            detail: updatedData 
        }));
    }

    // Function to load user data into form
    function loadUserData() {
        const userData = JSON.parse(localStorage.getItem('loggedInUser'));
        if (userData) {
            // Load profile image
            if (userData.profileImage) {
                document.getElementById('profilePreview').src = userData.profileImage;
            }
            
            // Load form fields
            document.getElementById('firstName').value = userData.firstName || '';
            document.getElementById('lastName').value = userData.lastName || '';
            document.getElementById('email').value = userData.email || '';
            document.getElementById('phone').value = userData.phone || '';
            document.getElementById('address').value = userData.address || '';
        }
    }

    // Load saved profile data
    function loadProfileData() {
        const userData = JSON.parse(localStorage.getItem('loggedInUser'));
        if (userData) {
            document.getElementById('firstName').value = userData.firstName || '';
            document.getElementById('lastName').value = userData.lastName || '';
            document.getElementById('email').value = userData.email || '';
            document.getElementById('phone').value = userData.phone || '';
            document.getElementById('address').value = userData.address || '';
            
            // Load profile image if exists
            if (userData.profileImage) {
                document.getElementById('profilePreview').src = userData.profileImage;
            }
        }
    }

    // Add form submit handler
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        e.preventDefault();
        saveProfileData();
    });

    // Load data when page loads
    window.addEventListener('load', loadProfileData);

    // Auto-save on input changes
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('change', saveProfileData);
    });

    function removeProfilePhoto() {
        const defaultImage = 'https://cdn.vectorstock.com/i/1000v/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.jpg';
        
        // Update profile preview
        document.getElementById('profilePreview').src = defaultImage;
        
        // Update localStorage
        const currentUser = JSON.parse(localStorage.getItem('loggedInUser'));
        if (currentUser) {
            currentUser.profileImage = defaultImage;
            localStorage.setItem('loggedInUser', JSON.stringify(currentUser));
            
            // Broadcast the change event
            const event = new CustomEvent('profileImageUpdated', {
                detail: { image: defaultImage }
            });
            window.dispatchEvent(event);
        }
    }

    // Load current user's profile image on page load
    window.addEventListener('load', function() {
        const currentUser = JSON.parse(localStorage.getItem('loggedInUser'));
        if (currentUser && currentUser.profileImage) {
            document.getElementById('profilePreview').src = currentUser.profileImage;
        }
    });

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        loadUserData();
        document.getElementById('profile-form').addEventListener('submit', saveProfileData);
    });
    </script>
</body>
</html>