<?php
session_start();
// Ensure only admin or authorized users can access this page


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password
    $role = $_POST['role'];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "dental_clinic";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New User</title>
</head>
<body>
    <h2>Register New User</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="doctor">Doctor</option>
            <option value="reception">Receptionist</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
