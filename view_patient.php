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

    // Fetch patient information based on name
    $sql = "SELECT * FROM Patients WHERE name = '$patient_name'";
    $result = mysqli_query($conn, $sql);

    // Display patient information
    while($row = mysqli_fetch_assoc($result)) {
        echo "Patient Name: " . $row['name'] . "<br>";
        echo "Contact Information: " . $row['contact_info'] . "<br>";
        // ... other patient details
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Patient Information</title>
</head>
<body>
    <h2>View Patient Information</h2>
    <form method="post">
        <label for="patient_name">Patient Name:</label>
        <input type="text" name="patient_name" required><br>
        <input type="submit" value="Search">
    </form>
</body>
</html>