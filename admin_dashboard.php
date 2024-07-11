<?php
include_once "./dbConnection.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    exit();
}

// Function to get the number of booked rooms for each room type
function getBookedRoomsCount($conn, $roomType) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM bookings WHERE roomType = ?");
    $stmt->bind_param("s", $roomType);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row["count"];
}

// Function to get the status of each room type
function getRoomStatus($conn, $roomType, $totalRooms) {
    $bookedRooms = getBookedRoomsCount($conn, $roomType);
    $availableRooms = $totalRooms - $bookedRooms;
    return $availableRooms;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Room Status</title>
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
        <h1>Room Status</h1>

        <!-- Section to show status of each room type -->
        <div class="dashboard-section">
            <h2>Room Status</h2>
            <table>
                <tr>
                    <th>Room Type</th>
                    <th>Available Rooms</th>
                </tr>
                <tr>
                    <td>Single room</td>
                    <td><?php echo getRoomStatus($conn, 'Single room', 12); ?></td>
                </tr>
                <tr>
                    <td>Deluxe room</td>
                    <td><?php echo getRoomStatus($conn, 'Deluxe room', 8); ?></td>
                </tr>
                <tr>
                    <td>Twin room</td>
                    <td><?php echo getRoomStatus($conn, 'Twin room', 6); ?></td>
                </tr>
                <tr>
                    <td>Suite room</td>
                    <td><?php echo getRoomStatus($conn, 'Suite room', 5); ?></td>
                </tr>
                <tr>
                    <td>Family room</td>
                    <td><?php echo getRoomStatus($conn, 'Family room', 7); ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
