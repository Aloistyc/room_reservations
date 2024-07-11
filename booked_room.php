<?php
include_once "./dbConnection.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    exit();
}

// Function to fetch booked rooms data from bookings table
function fetchBookedRoomsData($conn) {
    $sql = "SELECT firstName, lastName, email, phone, paymentMethod, roomNumber, roomType, checkin, checkout
            FROM bookings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // Return empty array if no bookings found
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Booked Rooms</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Link to external CSS file -->
</head>
<body>
    <div class="sidebar">
        <a href="admin_dashboard.php">Room Status</a>
        <a href="booked_room.php">Booked Rooms</a>
        <a href="book_room.php">Book a Room</a>
        <a href="report.php">Download Report</a>
    </div>

    <div class="content">
        <h1>Booked Rooms</h1>

        <!-- Section to display booked rooms data -->
        <div class="dashboard-section">
            <h2>Booked Rooms</h2>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Payment Method</th>
                    <th>Room No</th>
                    <th>Room Type</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                </tr>
                <?php
                $bookedRoomsData = fetchBookedRoomsData($conn);
                foreach ($bookedRoomsData as $booking) {
                    echo "<tr>";
                    echo "<td>" . $booking['firstName'] . "</td>";
                    echo "<td>" . $booking['lastName'] . "</td>";
                    echo "<td>" . $booking['email'] . "</td>";
                    echo "<td>" . $booking['phone'] . "</td>";
                    echo "<td>" . $booking['paymentMethod'] . "</td>";
                    echo "<td>" . $booking['roomNumber'] . "</td>";
                    echo "<td>" . $booking['roomType'] . "</td>";
                    echo "<td>" . $booking['checkin'] . "</td>";
                    echo "<td>" . $booking['checkout'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
