<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Student Information Form</h2>
        <form action="process_form.php" method="post">
            <!-- Your form fields here -->

            <h3>Subjects</h3>
            <table>
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                        <th>Unit</th>
                        <th>Midterm Grade</th>
                        <th>Finalterm Grade</th>
                        <th>Final Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- This is a single row for data entry -->
                    <tr>
                        <td><input type="text" name="subjectcode[]" required></td>
                        <td><input type="text" name="subjectdescription[]" required></td>
                        <td><input type="text" name="unit[]" required></td>
                        <td><input type="text" name="midtermgrade[]" required></td>
                        <td><input type="text" name="finaltermgrade[]" required></td>
                        <td><input type="text" name="finalgrade[]" required></td>
                    </tr>
                    <!-- You can add more rows as needed -->
                </tbody>
            </table>

            <div class="form-buttons">
                <button type="button" onclick="addRow()">Add Row</button>
                <button type="submit" name="save_manual_data" class="btn btn-primary">SAVE</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript function to add a new row for data entry
        function addRow() {
            const table = document.querySelector('table tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" name="subjectcode[]" required></td>
                <td><input type="text" name="subjectdescription[]" required></td>
                <td><input type="text" name="unit[]" required></td>
                <td><input type="text" name="midtermgrade[]" required></td>
                <td><input type="text" name="finaltermgrade[]" required></td>
                <td><input type="text" name="finalgrade[]" required></td>
            `;
            table.appendChild(newRow);
        }
    </script>
</body>
</html>
