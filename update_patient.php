<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Information</title>
    <script>
        function toggleFemaleFields() {
            const gender = document.getElementById('gender').value;
            const femaleFields = document.getElementById('femaleFields');
            if (gender === 'Female') {
                femaleFields.style.display = 'block';
            } else {
                femaleFields.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <h2>Update Patient Information</h2>
    <form method="POST">
        <label for="name">Patient Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($patient['name']) ? $patient['name'] : ''; ?>" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo isset($patient['age']) ? $patient['age'] : ''; ?>" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required onchange="toggleFemaleFields()">
            <option value="Male" <?php echo (isset($patient['gender']) && $patient['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo (isset($patient['gender']) && $patient['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo (isset($patient['gender']) && $patient['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select><br><br>

        <!-- Female specific fields -->
        <div id="femaleFields" style="display: none;">
            <label for="pregnancy_status">pregnant?</label>
            <select id="pregnancy_status" name="pregnancy_status">
                <option value="No" <?php echo (isset($patient['pregnancy_status']) && $patient['pregnancy_status'] == 'No') ? 'selected' : ''; ?>>No</option>
                <option value="Yes" <?php echo (isset($patient['pregnancy_status']) && $patient['pregnancy_status'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
            </select><br><br>

            <label for="menstrual_cycle">Describe your menstrual cycle (if applicable):</label>
            <textarea id="menstrual_cycle" name="menstrual_cycle"><?php echo isset($patient['menstrual_cycle']) ? $patient['menstrual_cycle'] : ''; ?></textarea><br><br>
        </div>

        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" value="<?php echo isset($patient['contact']) ? $patient['contact'] : ''; ?>" required><br><br>

        <label for="medical_history">Medical History:</label>
        <textarea id="medical_history" name="medical_history"><?php echo isset($patient['medical_history']) ? $patient['medical_history'] : ''; ?></textarea><br><br>

        <label for="current_medications">Current Medications:</label>
        <textarea id="current_medications" name="current_medications"><?php echo isset($patient['current_medications']) ? $patient['current_medications'] : ''; ?></textarea><br><br>

        <label for="habits">Habits (Smoking, Gutka, etc.):</label>
        <textarea id="habits" name="habits"><?php echo isset($patient['habits']) ? $patient['habits'] : ''; ?></textarea><br><br>

        <label for="allergies">Allergies:</label>
        <textarea id="allergies" name="allergies"><?php echo isset($patient['allergies']) ? $patient['allergies'] : ''; ?></textarea><br><br>

        <input type="submit" value="Update Patient">
    </form>

    <script>
        // Ensure correct field visibility on page load
        toggleFemaleFields();
    </script>
</body>
</html>
