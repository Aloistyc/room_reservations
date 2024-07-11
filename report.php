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
    $sql = "SELECT firstName, lastName, email, phone, paymentMethod,roomNumber, roomType, checkin, checkout 
            FROM bookings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // Return empty array if no bookings found
    }
}

// Function to generate CSV report and force download
function downloadCSVReport($bookings) {
    $filename = 'booked_rooms_report.csv';
    $fp = fopen('php://output', 'w');

    // Output CSV headers
    fputcsv($fp, array('First Name', 'Last Name', 'Email', 'Phone Number', 'Payment Method','roomNumber', 'Room Type', 'Check-in', 'Check-out'));

    // Output CSV data
    foreach ($bookings as $booking) {
        fputcsv($fp, $booking);
    }

    fclose($fp);

    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    exit();
}

// Fetch booked rooms data
$bookedRoomsData = fetchBookedRoomsData($conn);

// Handle CSV download request
if (isset($_POST['download_csv'])) {
    downloadCSVReport($bookedRoomsData);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Download Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .sidebar {
    height: 100%;
    width: 200px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #333;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidebar a {
    padding: 10px 8px 10px 16px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
}

.sidebar a:hover {
    background-color: #555;
}

        
        .content {
            margin-left: 200px;
            padding: 20px;
        }

        .content h1 {
            margin-top: 0;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin_dashboard.php">Room Status</a>
        <a href="booked_room.php">Booked Rooms</a>
        <a href="book_room.php">Book a Room</a>
        <a href="report_download.php">Download Report</a>
    </div>

    <div class="content">
        <h1>Download Booked Rooms Report</h1>
        <p>Download the booked rooms report in CSV format:</p>
        <form method="post">
            <button class="btn" type="submit" name="download_csv">Download CSV</button>
        </form>

        <!-- Display booked rooms data in a table -->
        <div class="dashboard-section">
            <h2>Booked Rooms Data</h2>
            <table border="1" cellspacing="0" cellpadding="5">
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
                foreach ($bookedRoomsData as $booking) {
                    echo "<tr>";
                    echo "<td>" . $booking['firstName'] . "</td>";
                    echo "<td>" . $booking['lastName'] . "</td>";
                    echo "<td>" . $booking['email'] . "</td>";
                    echo "<td>" . $booking['phone'] . "</td>";
                    echo "<td>" . $booking['paymentMethod'] . "</td>";
                    echo "<td>" . $booking
                    ['roomNumber'] . "</td>";
                    echo "<td>" . $booking
                    ['roomType'] . "</td>";
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
