<?php
session_start();
var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $requiredFields = ['sno','sy1', 'sy2', 'semester', 'scode', 'MT', 'FT', 'FG'];

    foreach($requiredFields as $field) {
        if(empty($_POST[$field])) {
            $_SESSION['message2'] = 'Please complete the form.';
            header("Location: inputgrades.php");
            exit();
        }
    }

    $con = mysqli_connect("localhost", "root", "", "uccevaluation");

    if(!$con) {
        die("Connection Error: ".mysqli_connect_error());
    }

    $selectQuery = "SELECT campus_name FROM campus";
    $result = mysqli_query($con, $selectQuery);
    $campusRow = mysqli_fetch_assoc($result);
    $selectedCampus = $campusRow['campus_name'];

    $tableName = "student".$_POST['semester']."sem".$_POST['sy1'].$_POST['sy2'];
    $tableName1 = $_POST['sy1'].$_POST['sy2'].$_POST['semester']."sem".$selectedCampus;

    $useTableName1 = ($selectedCampus === 'Congress');
    $tableNameToUse = $useTableName1 ? $tableName1 : $tableName;

    // Move this line outside the inner loop
    $scode = $_POST['scode'];

    for($i = 0; $i < count($_POST['sno']); $i++) {
        $sno = $_POST['sno'][$i];

        echo "Debug: Current sno - $sno<br>";
        for($j = 1; $j <= 10; $j++) {
            $scodeColumnName = "scode".$j;
            $mtColumnName = "mt".$j;
            $ftColumnName = "ft".$j;
            $fgColumnName = "fg".$j;

            $selectQuery3 = "SELECT sno FROM $tableNameToUse WHERE sno=? AND $scodeColumnName=?";
            $stmtSelect = mysqli_prepare($con, $selectQuery3);

            // Correct usage of mysqli_stmt_bind_param
            mysqli_stmt_bind_param($stmtSelect, "ss", $sno, $scode);

            mysqli_stmt_execute($stmtSelect);
            mysqli_stmt_store_result($stmtSelect);

            if(mysqli_stmt_num_rows($stmtSelect) > 0) {
                $updateQuery = "UPDATE $tableNameToUse SET $mtColumnName=?, $ftColumnName=?, $fgColumnName=? WHERE sno=? AND $scodeColumnName=?";
                $stmtUpdate = mysqli_prepare($con, $updateQuery);

                $mtValue = $_POST['MT'][$i];
                $ftValue = $_POST['FT'][$i];
                $fgValue = $_POST['FG'][$i];

                mysqli_stmt_bind_param($stmtUpdate, "dddss", $mtValue, $ftValue, $fgValue, $sno, $scode);

                mysqli_stmt_execute($stmtUpdate);
                $debugQuery = "UPDATE $tableNameToUse SET $mtColumnName=$mtValue, $ftColumnName=$ftValue, $fgColumnName=$fgValue WHERE sno=$sno AND $scodeColumnName=$scode";
                echo "<br>Debug: $debugQuery<br>";

                if(mysqli_stmt_affected_rows($stmtUpdate) > 0) {
                    echo "Record updated successfully for $scodeColumnName!<br>";
                } else {
                    echo "Error updating record for $scodeColumnName: ".mysqli_stmt_error($stmtUpdate)."<br>";
                }

                mysqli_stmt_close($stmtUpdate);
            } else {
                echo "<br>Record not found for sno=$sno and $scodeColumnName=$scode<br>";
            }

            mysqli_stmt_close($stmtSelect);
        }
    }

    mysqli_close($con);
}
?>
    