<?php

// Database connection
$host = "localhost";
$user = "username";
$pass = "password";
$db = "appointments";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST["name"],
        'email' => $_POST["email"],
        'phone' => $_POST["phone"],
        'date' => $_POST["date"],
        'time' => $_POST["time"],
        'service' => $_POST["service"]
    ];

    $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, date, time, service) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $data['name'], $data['email'], $data['phone'], $data['date'], $data['time'], $data['service']);

    if ($stmt->execute()) {
        echo "Appointment scheduled successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Scheduler</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="submit"] { background-color: #28a745; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #218838; }
    </style>
</head>
<body>

<h2>Schedule Your Appointment</h2>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <label for="time">Time:</label>
    <input type="time" id="time" name="time" required>

    <label for="service">Service:</label>
    <select id="service" name="service" required>
        <option value="Consultation">Consultation</option>
        <option value="Check-up">Check-up</option>
        <option value="Surgery">Surgery</option>
    </select>

    <input type="submit" value="Schedule Appointment">
</form>

</body>
</html>

<?php
$conn->close();
?>