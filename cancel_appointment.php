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
    $appointment_id = $_POST['appointment_id'];

    // Update the appointment status to 'canceled'
    $sql = "UPDATE Appointment SET status = 'canceled' WHERE id = $appointment_id";

    if (mysqli_query($conn, $sql)) {
        echo "Appointment canceled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch appointments to display for cancellation
$sql = "SELECT * FROM Appointment";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cancel Appointment</title>
</head>
<body>
    <h2>Cancel Appointment</h2>
    <form method="post">
        <label for="appointment_id">Appointment ID:</label>
        <select name="appointment_id">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['patient_name'] . ' - ' . $row['appointment_date'] . ' ' . $row['appointment_time']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Cancel Appointment">
    </form>
</body>
</html>