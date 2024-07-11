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

// Handle booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $clientEmail = $_POST['clientEmail'];
    $phoneNumber = $_POST['phoneNumber'];
    $checkinDate = $_POST['checkinDate'];
    $checkoutDate = $_POST['checkoutDate'];
    $roomType = $_POST['roomType'];
    $paymentMethod = $_POST['paymentMethod'];

    $sql = "INSERT INTO bookings (firstName, lastName, email, phoneNumber, checkin, checkout, roomType, paymentMethod) 
            VALUES ('$firstName', '$lastName', '$clientEmail', '$phoneNumber', '$checkinDate', '$checkoutDate', '$roomType', '$paymentMethod')";

    if ($conn->query($sql) === TRUE) {
        $bookingSuccess = "Room booked successfully!";
    } else {
        $bookingError = "Error booking the room: " . $conn->error;
    }
}

// Function to fetch all bookings
function getAllBookings($conn) {
    $sql = "SELECT firstName, lastName, email, phoneNumber, paymentMethod, roomType, checkin, checkout FROM bookings";
    $result = $conn->query($sql);
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .dashboard-section {
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

        form {
            max-width: 400px;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type=text], input[type=email], input[type=date], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

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

    <!-- Section to display booked rooms -->
    <div class="dashboard-section">
        <h2>Booked Rooms</h2>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Payment Method</th>
                <th>Room Type</th>
                <th>Check-in</th>
                <th>Check-out</th>
            </tr>
            <?php
            $bookings = getAllBookings($conn);
            if ($bookings->num_rows > 0) {
                while ($row = $bookings->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['firstName'] . "</td>";
                    echo "<td>" . $row['lastName'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phoneNumber'] . "</td>";
                    echo "<td>" . $row['paymentMethod'] . "</td>";
                    echo "<td>" . $row['roomType'] . "</td>";
                    echo "<td>" . $row['checkin'] . "</td>";
                    echo "<td>" . $row['checkout'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No bookings found</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Section to book a room for a client -->
    <div class="dashboard-section">
        <h2>Book a Room for Client</h2>
        <?php
        if (isset($bookingSuccess)) {
            echo "<p style='color: green;'>$bookingSuccess</p>";
        } elseif (isset($bookingError)) {
            echo "<p style='color: red;'>$bookingError</p>";
        }
        ?>
        <form action="" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="clientEmail">Email:</label>
            <input type="email" id="clientEmail" name="clientEmail" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>

            <label for="checkinDate">Check-in Date:</label>
            <input type="date" id="checkinDate" name="checkinDate" required>

            <label for="checkoutDate">Check-out Date:</label>
            <input type="date" id="checkoutDate" name="checkoutDate" required>

            <label for="roomType">Room Type:</label>
            <select id="roomType" name="roomType" required>
                <option value="Single room">Single room</option>
                <option value="Deluxe room">Deluxe room</option>
                <option value="Twin room">Twin room</option>
                <option value="Suite room">Suite room</option>
                <option value="Family room">Family room</option>
            </select>

            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="Mpesa">Mpesa</option>
                <option value="Paypal">Paypal</option>
                <option value="Card">Card</option>
            </select>

            <button type="submit">Book Room</button>
        </form>
    </div>

    <!-- Section to download report -->
    <div class="dashboard-section">
        <h2>Download Report</h2>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Payment Method</th>
                <th>Room Type</th>
                <th>Check-in</th>
                <th>Check-out</th>
            </tr>
            <?php
            $bookings = getAllBookings($conn);
            if ($bookings->num_rows > 0) {
                while ($row = $bookings->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['firstName'] . "</td>";
                    echo "<td>" . $row['lastName'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phoneNumber'] . "</td>";
                    echo "<td>" . $row['paymentMethod'] . "</td>";
                    echo "<td>" . $row['roomType'] . "</td>";
                    echo "<td>" . $row['checkin'] . "</td>";
                    echo "<td>" . $row['checkout'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No bookings found</td></tr>";
            }
            ?>
        </table>
        <br>
        <a href="download_report.php?format=pdf">Download as PDF</a>
        <br>
        <a href="download_report.php?format=csv">Download as CSV</a>
    </div>

</body>
</html>
