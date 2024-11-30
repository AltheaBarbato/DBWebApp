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

$sql = "SELECT * FROM Appointment";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Appointments</title>
</head>
<body>
    <h2>Appointments</h2>
    <table>
        <tr>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['patient_name']; ?></td>
                <td><?php echo $row['doctor_name']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['appointment_time']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>