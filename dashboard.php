<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dental Clinic</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard">
        <h2>Welcome, <?php echo ucfirst($_SESSION['role']); ?></h2>
        <div class="dashboard-links">
            <?php if ($_SESSION['role'] == 'doctor') { ?>
                <a href="patients.php">View Patients</a>
                <a href="add_treatment.php">Add Treatment</a>
            <?php } elseif ($_SESSION['role'] == 'reception') { ?>
                <a href="register_patient.php">Register New Patient</a>
            <?php } elseif ($_SESSION['role'] == 'admin') { ?>
                <a href="register_user.php">Register New User</a>
                <a href="view_users.php">View Users</a>
            <?php } ?>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
