<?php
session_start();
if ($_SESSION['role'] != 'doctor') {
    header('Location: dashboard.php');
    exit;
}

$patient_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $treatments = $_POST['treatments'];  // This is an array of treatments

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dental_clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    foreach ($treatments as $treatment) {
        $tooth_number = $treatment['tooth_number'];
        $problem = $treatment['problem'];
        $treatment_date = $treatment['treatment_date'];
        $notes = $treatment['notes'];

        $sql = "INSERT INTO treatments (patient_id, tooth_number, treatment, treatment_date, notes)
                VALUES ('$patient_id', '$tooth_number', '$problem', '$treatment_date', '$notes')";

        if (!$conn->query($sql)) {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
    echo "All treatments added successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Multiple Treatments</title>
</head>
<body>
    <h2>Add Multiple Treatments for Patient ID: <?php echo $patient_id; ?></h2>
    <form method="POST">
        <div class="treatment-group">
            <label for="tooth_number">Tooth Number:</label>
            <input type="number" name="treatments[0][tooth_number]" required>

            <label for="problem">Problem:</label>
            <input type="text" name="treatments[0][problem]" required>

            <label for="treatment_date">Date:</label>
            <input type="date" name="treatments[0][treatment_date]" required>

            <label for="notes">Notes:</label>
            <textarea name="treatments[0][notes]"></textarea>
        </div>

        <div class="treatment-group">
            <label for="tooth_number">Tooth Number:</label>
            <input type="number" name="treatments[1][tooth_number]" required>

            <label for="problem">Problem:</label>
            <input type="text" name="treatments[1][problem]" required>

            <label for="treatment_date">Date:</label>
            <input type="date" name="treatments[1][treatment_date]" required>

            <label for="notes">Notes:</label>
            <textarea name="treatments[1][notes]"></textarea>
        </div>

        <!-- Add more treatment groups if needed -->
        <button type="button" onclick="addMoreTreatments()">Add More Treatments</button>

        <input type="submit" value="Submit All Treatments">
    </form>

    <script>
        function addMoreTreatments() {
            const treatmentGroup = document.querySelector('.treatment-group');
            const newGroup = treatmentGroup.cloneNode(true);
            document.querySelector('form').insertBefore(newGroup, document.querySelector('button'));
        }
    </script>
</body>
</html>
