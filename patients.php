<?php
session_start();
if ($_SESSION['role'] != 'doctor') {
    header('Location: dashboard.php');
    exit;
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "dental_clinic";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
</head>
<body>
    <h2>Registered Patients</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Medical History</th>
            <th>Current Medications</th>
            <th>Habits</th>
            <th>Allergies</th>
            <th>Edit</th>
        </tr>
        <?php while ($patient = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $patient['name']; ?></td>
                <td><?php echo $patient['age']; ?></td>
                <td><?php echo $patient['gender']; ?></td>
                <td><?php echo $patient['contact']; ?></td>
                <td><?php echo $patient['medical_history']; ?></td>
                <td><?php echo $patient['current_medications']; ?></td>
                <td><?php echo $patient['habits']; ?></td>
                <td><?php echo $patient['allergies']; ?></td>
                <td><a href="register_patient.php?id=<?php echo $patient['id']; ?>">Edit</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
