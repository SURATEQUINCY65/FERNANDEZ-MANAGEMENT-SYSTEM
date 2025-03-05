<?php
// Start session to store user login state
session_start();

// Define correct email and password (for demo purposes, this could be fetched from a database)
$correct_email = "admin@gmail.com";
$correct_password = "admin123";  // In a real-world scenario, this would be hashed and stored securely

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password entered by the user
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the email and password
    if ($email == $correct_email && $password == $correct_password) {
        // Successful login: redirect to the admin dashboard or home page
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: http://localhost/clinic-website-template/New%20folder/panel.php");
        exit();
    } else {
        // Invalid login: show error message
        $error_message = "Incorrect email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .login-container {
            width: 300px;
            margin: 100px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>

    <!-- Display error message if login fails -->
    <?php if (isset($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>

    <form action="" method="POST" onsubmit="return validateLoginForm()">
        <input type="email" name="email" placeholder="Enter your email" required><br>
        <input type="password" name="password" placeholder="Enter your password" required><br>
        <input type="submit" value="Login">
        <a href="index.php" class="link-btn">Back</a>
    </form>
</div>

<script>
    function validateLoginForm() {
        const email = document.forms[0]["email"].value;
        const password = document.forms[0]["password"].value;

        // Simple email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            return false; // Prevent form submission
        }

        // Check password length
        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
</div>

</body>
</html>
