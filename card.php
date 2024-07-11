<?php
// Function to generate and assign room numbers based on room type
function generateRoomNumber($roomType) {
    switch ($roomType) {
        case "Single room":
            $roomNumbers = range(101, 110);
            return $roomNumbers[array_rand($roomNumbers)]; // Randomly pick a room number from the range
        case "Deluxe room":
            $roomNumbers = range(111, 118);
            return $roomNumbers[array_rand($roomNumbers)];
        case "Twin room":
            $roomNumbers = range(119, 124); // Adjusted to fit the given range (6 rooms)
            return $roomNumbers[array_rand($roomNumbers)];
        case "Suite room":
            $roomNumbers = range(125, 127); // Adjusted to fit the given range (3 rooms)
            return $roomNumbers[array_rand($roomNumbers)];
        case "Family room":
            $roomNumbers = range(128, 134); // Adjusted to fit the given range (7 rooms)
            return $roomNumbers[array_rand($roomNumbers)];
        default:
            return "N/A";
    }
}

// Function to fetch booking data from bookings table
function fetchBookingsData($conn) {
    $sql = "SELECT firstName, email, phone, roomType, checkin, checkout FROM bookings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // Return empty array if no bookings found
    }
}

// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Room";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch booking data
$bookingsData = fetchBookingsData($conn);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .booking-card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Booking Details</h1>

    <?php foreach ($bookingsData as $booking): ?>
    <div class="booking-card">
        <h2>Booking Information</h2>
        <table>
            <tr>
                <th>First Name</th>
                <td><?php echo $booking['firstName']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $booking['email']; ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo $booking['phone']; ?></td>
            </tr>
            <tr>
                <th>Room Type</th>
                <td><?php echo $booking['roomType']; ?></td>
            </tr>
            <tr>
                <th>Check-in</th>
                <td><?php echo $booking['checkin']; ?></td>
            </tr>
            <tr>
                <th>Check-out</th>
                <td><?php echo $booking['checkout']; ?></td>
            </tr>
            <tr>
                <th>Room Number</th>
                <td><?php echo generateRoomNumber($booking['roomType']); ?></td>
            </tr>
        </table>
    </div>
    <?php endforeach; ?>
</body>
</html>
