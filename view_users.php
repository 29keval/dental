<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: dashboard.php');
    exit;
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "dental_clinic";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
</head>
<body>
    <h2>Registered Users</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Date Registered</th>
        </tr>
        <?php while ($user = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
