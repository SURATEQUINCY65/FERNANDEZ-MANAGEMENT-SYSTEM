<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        .hidden {
            display: none;
        }
        .slide-in {
            animation: slide-in 0.5s forwards;
        }
        .slide-out {
            animation: slide-out 0.5s forwards;
        }
        @keyframes slide-in {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }
        @keyframes slide-out {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md">
        <div id="login-form" class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">LOGIN</h2>
            <form id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="****************">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="login()">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 cursor-pointer" onclick="showRegistrationForm()">
                        Register
                    </a>
                </div>
            </form>
        </div>

        <div id="registration-form" class="bg-white p-8 rounded-lg shadow-lg hidden">
            <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
            <form id="registrationForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="newUsername">Username</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="newUsername" type="text" placeholder="Username">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="newEmail">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newEmail" type="email" placeholder="Email">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="newPassword">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="newPassword" type="password" placeholder="****************">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="register()">
                        Register
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 cursor-pointer" onclick="showLoginForm()">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let users = JSON.parse(localStorage.getItem('users')) || [];

        function showRegistrationForm() {
            document.getElementById('login-form').classList.add('slide-out');
            setTimeout(() => {
                document.getElementById('login-form').classList.add('hidden');
                document.getElementById('login-form').classList.remove('slide-out');
                document.getElementById('registration-form').classList.remove('hidden');
                document.getElementById('registration-form').classList.add('slide-in');
            }, 500);
        }

        function showLoginForm() {
            document.getElementById('registration-form').classList.add('slide-out');
            setTimeout(() => {
                document.getElementById('registration-form').classList.add('hidden');
                document.getElementById('registration-form').classList.remove('slide-out');
                document.getElementById('login-form').classList.remove('hidden');
                document.getElementById('login-form').classList.add('slide-in');
            }, 500);
        }

        function register() {
    const username = document.getElementById('newUsername').value;
    const email = document.getElementById('newEmail').value;
    const password = document.getElementById('newPassword').value;

    if (username && email && password) {
        const userData = {
            username: username,
            email: email,
            password: password, // In production, this should be properly hashed
            timestamp: new Date().toISOString()
        };
        
        // Save user data
        users.push(userData);
        localStorage.setItem('users', JSON.stringify(users));
        
        // Set as logged in user
        localStorage.setItem('loggedInUser', JSON.stringify(userData));
        alert('Registration successful! Logging in...');
        window.location.href = 'home.php';
    } else {
        alert('Please fill in all fields.');
    }
}

        function login() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const user = users.find(user => user.username === username && user.password === password);

            if (user) {
                localStorage.setItem('loggedInUser', JSON.stringify(user));
                alert('Login successful! Redirecting to homepage...');
                window.location.href = 'home.php';
            } else {
                alert('Invalid username or password.');
            }
        }
        
        // Example user object structure in localStorage
const currentUser = {
    id: "unique_user_id",
    username: "username",
    // other user details
};
localStorage.setItem('currentUser', JSON.stringify(currentUser));
    </script>
</body>
</html>
