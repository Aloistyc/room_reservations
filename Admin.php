<?php
include_once "./dbConnection.php";

$error = '';

    if (isset($_POST["submit"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hashed_password = md5($password);
    
        // echo $username;
        // echo $password;
        // echo $hashed_password . "<br><br>";

        // Checking if the credentials are correct
        $userQuery = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($conn, $userQuery);
        $row = mysqli_fetch_assoc($result);

        if($hashed_password === $row["password_hash"])
        {
            echo "Login successful";
            session_start();
            $_SESSION["admin_logged_in"]=true;
            header("Location: admin_dashboard.php");
            exit();
        }
        elseif($hashed_password !== $row["password_hash"])
        {
            $error="Invalid credentials";
        }
        else
        {
            $error="Admin not found";
        }
        // if (!$row) {
        //     $error = "Admin not found";
        // } elseif ($hashed_password == $row["password"] && $username == $row["username"]) {
        //     session_start();
        //     $_SESSION["admin_logged_in"] = true;
        //     header("Location: admin_dashboard.php");
        //     exit();
        // } else {
        //     $error = "Invalid login credentials";
        // }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red; text-align: center; margin-bottom: 15px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="./Admin.php" method="post" class="login-form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>
