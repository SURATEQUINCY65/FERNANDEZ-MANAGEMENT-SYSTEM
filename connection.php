<?php
error_reporting(0);
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'm_db'; // Database name
$username = 'your_username'; // Database username
$password = 'your_password'; // Database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $appointment_time = $_POST['appointment-time'];
    $lenses = $_POST['lenses']; 

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, date, appointment_time, product, lenses) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $date, $appointment_time, $product, $lenses);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New appointment scheduled successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>