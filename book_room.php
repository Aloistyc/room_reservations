<?php
session_start();

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data (use mysqli_real_escape_string to prevent SQL injection)
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['clientEmail']);
    $phone = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $checkinDate = mysqli_real_escape_string($conn, $_POST['checkinDate']);
    $checkoutDate = mysqli_real_escape_string($conn, $_POST['checkoutDate']);
    $roomType = mysqli_real_escape_string($conn, $_POST['roomType']);
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod']);

    // Generate room number
    $roomNumber = generateRoomNumber($roomType);

    // Prepare and execute SQL insert statement
    $sql = "INSERT INTO bookings (firstName, lastName, email, phone, checkin, checkout, roomType, paymentMethod, roomNumber) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$checkinDate', '$checkoutDate', '$roomType', '$paymentMethod', '$roomNumber')";

    if ($conn->query($sql) === TRUE) {
        $bookingSuccess = "Room booked successfully! Room number assigned: " . $roomNumber;
    } else {
        $bookingError = "Error booking the room: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Book a Room</title>
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
        <h1>Book a Room</h1>

        <!-- Section to book a room for a client -->
        <div class="dashboard-section">
            <h2>Book a Room</h2>
            <?php if (isset($bookingSuccess)): ?>
                <p style="color: green;"><?php echo $bookingSuccess; ?></p>
            <?php elseif (isset($bookingError)): ?>
                <p style="color: red;"><?php echo $bookingError; ?></p>
            <?php endif; ?>
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
    </div>
</body>
</html>
