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
    // Collect form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $roomType = $_POST['roomType'];
    $paymentMethod = $_POST['paymentMethod'];

    // Generate room number
    $roomNumber = generateRoomNumber($roomType);

    // Prepare and execute SQL insert statement
    $sql = "INSERT INTO bookings (firstName, lastName, email, phone, checkin, checkout, roomType, paymentMethod, roomNumber) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$checkin', '$checkout', '$roomType', '$paymentMethod', '$roomNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful. Room number assigned: " . $roomNumber;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
