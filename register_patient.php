<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include the database connection
    include 'db.php';

    // Get form data
    $name = $_POST['name'];
    $dob = $_POST['dob']; // Date of Birth
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $medical_history = $_POST['medical_history'];
    $current_medications = $_POST['current_medications'];
    $habits = isset($_POST['habits']) ? implode(', ', $_POST['habits']) : '';  // Convert habits array to a comma-separated string
    $pregnancy_status = $_POST['pregnancy_status'];
    $menstrual_cycle = $_POST['menstrual_cycle'];
    $medical_problems = isset($_POST['medical_problems']) ? implode(', ', $_POST['medical_problems']) : '';  // Convert medical problems array to string
    $allergies = $_POST['allergies'];

    // Check if a patient with the same name and date of birth already exists
    $check_duplicate = "SELECT * FROM patients WHERE name = '$name' AND dob = '$dob'";
    $result = $conn->query($check_duplicate);

    if ($result->num_rows > 0) {
        // If a patient with the same name and DOB exists, show an error message
        echo "Error: A patient with the same name and date of birth already exists.";
    } else {
        // Insert new patient data into the database if no duplicates are found
        $sql = "INSERT INTO patients 
            (name, dob, gender, contact, medical_history, current_medications, habits, pregnancy_status, menstrual_cycle, medical_problems, allergies)
            VALUES 
            ('$name', '$dob', '$gender', '$contact', '$medical_history', '$current_medications', '$habits', '$pregnancy_status', '$menstrual_cycle', '$medical_problems', '$allergies')";

        // Check if the query was successful
        if ($conn->query($sql) === TRUE) {
            echo "Patient registered successfully!";
        } else {
            // Display error message if there is an issue
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Patient</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        // Function to toggle female-specific fields
        function toggleFemaleFields() {
            const gender = document.getElementById('gender').value;
            const femaleFields = document.getElementById('femaleFields');
            if (gender === 'Female') {
                femaleFields.style.display = 'block';
            } else {
                femaleFields.style.display = 'none';
            }
        }

        // Function to toggle "Other" input field for habits
        function toggleOtherHabit() {
            const otherHabitCheckbox = document.getElementById('other_habit');
            const otherHabitInput = document.getElementById('other_habit_input');
            if (otherHabitCheckbox.checked) {
                otherHabitInput.style.display = 'block';
            } else {
                otherHabitInput.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Register New Patient</h2>
        <form method="POST">
            <label for="name">Patient Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required onchange="toggleFemaleFields()">
                <option value="-">-</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>

            <!-- Female-specific fields -->
            <div id="femaleFields" style="display: none;">
                <label for="pregnancy_status">Are you pregnant?</label>
                <select id="pregnancy_status" name="pregnancy_status">
                    <option value="-">-</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select><br><br>

                <label for="menstrual_cycle">Describe your menstrual cycle (if applicable):</label>
                <textarea id="menstrual_cycle" name="menstrual_cycle"></textarea><br><br>
            </div>

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required><br><br>

            <label for="medical_history">Medical History:</label>
            <textarea id="medical_history" name="medical_history"></textarea><br><br>

            <!-- Medical Problems Section -->
            <label>Medical Problems (Check all that apply):</label><br>
            <input type="checkbox" name="medical_problems[]" value="Hypertension"> Hypertension<br>
            <input type="checkbox" name="medical_problems[]" value="Diabetes"> Diabetes<br>
            <input type="checkbox" name="medical_problems[]" value="Heart Disease"> Heart Disease<br>
            <input type="checkbox" name="medical_problems[]" value="Asthma"> Asthma<br>
            <input type="checkbox" name="medical_problems[]" value="Allergies"> Allergies<br>
            <input type="checkbox" name="medical_problems[]" value="Other" onclick="toggleOtherHabit()"> Other (Please Specify):
            <textarea id="medical_problem_input" name="other_medical_problem" style="display: none;"></textarea><br><br>

            <!-- Habits Section with Checkboxes -->
            <label>Habits (Check all that apply):</label><br>
            <input type="checkbox" name="habits[]" value="Smoking"> Smoking<br>
            <input type="checkbox" name="habits[]" value="Gutka"> Gutka<br>
            <input type="checkbox" name="habits[]" value="Alcohol"> Alcohol<br>
            <input type="checkbox" name="habits[]" value="Pan Masala"> Pan Masala<br>
            <input type="checkbox" id="other_habit" value="Other" onclick="toggleOtherHabit()"> Other:
            <textarea id="other_habit_input" name="other_habit_text" style="display: none;"></textarea><br><br>

            <label for="current_medications">Current Medications:</label>
            <textarea id="current_medications" name="current_medications"></textarea><br><br>

            <label for="allergies">Allergies:</label>
            <textarea id="allergies" name="allergies"></textarea><br><br>

            <input type="submit" value="Register Patient">
        </form>
    </div>

    <script>
        // Ensure correct field visibility on page load
        toggleFemaleFields();
        toggleOtherHabit();
    </script>
</body>
</html>
