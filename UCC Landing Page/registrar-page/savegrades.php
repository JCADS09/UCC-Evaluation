<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "", "uccevaluation");
    if (!$con) {
        die("Connection Error: " . mysqli_connect_error());
    }

    // Check if the subject code exists in the database
    if (isset($_POST['scode']) && !empty($_POST['scode'])) {
        $MT = $_POST['MT'];
        $FT = $_POST['FT'];
        $FG = $_POST['FG'];

        $selectQuery = "SELECT campus_name FROM campus";
        $result = mysqli_query($con, $selectQuery);
        $campusRow = mysqli_fetch_assoc($result);
        $selectedCampus = $campusRow['campus_name'];

        $tableName = "student" . $_POST['semester'] . "sem" . $_POST['sy1'] . $_POST['sy2'];
        $tableName1 = $_POST['sy1'] . $_POST['sy2'] . $_POST['semester'] . "sem" . $selectedCampus;

        // Define your condition here
        $useTableName1 = ($selectedCampus === 'Congress'); // Modify this condition accordingly

        // Use the dynamically determined table name based on the condition
        $tableNameToUse = $useTableName1 ? $tableName1 : $tableName;

        // Get sno and scode outside the loop
        $sno = $_POST['sno'];
        $scode = $_POST['scode'];

        // Loop through the subjects for which data is provided
        for ($i = 1; $i <= 10; $i++) {
            // Define the column names dynamically based on the loop index
            $scodeColumnName = "scode" . $i;
            $mtColumnName = "mt" . $i;
            $ftColumnName = "ft" . $i;
            $fgColumnName = "fg" . $i;

            // Check if the sno and scode exist in the table
            $selectQuery3 = "SELECT sno FROM $tableNameToUse WHERE sno=? AND $scodeColumnName=?";
            $stmtSelect = mysqli_prepare($con, $selectQuery3);
            mysqli_stmt_bind_param($stmtSelect, "ss", $sno, $scode);
            mysqli_stmt_execute($stmtSelect);
            mysqli_stmt_store_result($stmtSelect);

            if (mysqli_stmt_num_rows($stmtSelect) > 0) {
                // Update the grades if the sno and scode are found in the table
                $updateQuery = "UPDATE $tableNameToUse SET $mtColumnName=?, $ftColumnName=?, $fgColumnName=? WHERE sno=? AND $scodeColumnName=?";
                $stmtUpdate = mysqli_prepare($con, $updateQuery);

                // Bind parameters using references
                mysqli_stmt_bind_param($stmtUpdate, "sssss", $MT[$i - 1], $FT[$i - 1], $FG[$i - 1], $sno, $scode);

                mysqli_stmt_execute($stmtUpdate);

                if (mysqli_stmt_affected_rows($stmtUpdate) > 0) {
                    echo "Record updated successfully for $scodeColumnName!<br>";
                } else {
                    echo "Error updating record for $scodeColumnName: " . mysqli_stmt_error($stmtUpdate) . "<br>";
                    echo "Query: $updateQuery<br>";
                    echo "Parameters: mt={$MT[$i - 1]}, ft={$FT[$i - 1]}, fg={$FG[$i - 1]}, sno=$sno, scode=$scode<br>";
                }

                mysqli_stmt_close($stmtUpdate);
            } else {
                echo "Record not found for sno=$sno and $scodeColumnName=$scode<br>";
            }

            mysqli_stmt_close($stmtSelect);
        }
    }

    mysqli_close($con);
}
?>
                                                            