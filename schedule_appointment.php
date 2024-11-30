<?php
session_start();

// Ensure the user is logged in and is a staff member
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: index.php");
    exit;
}

// Database connection
$conn = mysqli_connect("localhost", "your_username", "your_password", "your_database_name");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $doctor_name = $_POST['doctor_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Insert the appointment into the database
    $sql = "INSERT INTO Appointment (patient_name, doctor_name, appointment_date, appointment_time, status) 
            VALUES ('$patient_name', '$doctor_name', '$appointment_date', '$appointment_time', 'scheduled')";

    if (mysqli_query($conn, $sql)) {
        echo "Appointment scheduled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Schedule Appointment</title>
</head>
<body>
    <h2>Schedule Appointment</h2>
    <form method="post">
        <label for="patient_name">Patient Name:</label>
        <input type="text" name="patient_name" required><br>

        <label for="doctor_name">Doctor Name:</label>
        <input type="text" name="doctor_name" required><br>

        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" required><br>

        <label for="appointment_time">Appointment Time:</label>
        <input type="time" name="appointment_time" required><br>

        <input type="submit" value="Schedule Appointment">
    </form>
</body>
</html>