<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'uccevaluation');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
   
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {

        $table_name = pathinfo($fileName, PATHINFO_FILENAME);

        $table_name = preg_replace('/[^a-zA-Z0-9_]/', '-', $table_name);
        $table_name = substr($table_name, 0, 64);

        try {
        $inputFileNamePath = $_FILES['import_file']['tmp_name']; 
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();
    
        if (is_array($data) && count($data) > 1) {
            $table_name = pathinfo($fileName, PATHINFO_FILENAME);
            $createTableSQL = "CREATE TABLE IF NOT EXISTS `$table_name` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                sname VARCHAR(255) NOT NULL,
                fname VARCHAR(255) NOT NULL,
                mname VARCHAR(255) NULL,
                sno INT(255) NOT NULL,
                sex VARCHAR(255) NULL,
                course VARCHAR(255) NOT NULL,
                year1 VARCHAR(255) NOT NULL,
                section VARCHAR(255) NOT NULL,
                status1 VARCHAR(255) NULL,
                semester VARCHAR(255) NOT NULL,
                sy1 INT(255) NOT NULL,
                sy2 INT(255) NOT NULL,
                date_enrol VARCHAR(255) NULL,
                scode1 VARCHAR(255) NULL,
                desc1 VARCHAR(255) NULL,
                unit1 VARCHAR(255) NULL,
                scode2 VARCHAR(255) NULL,
                desc2 VARCHAR(255) NULL,
                unit2 VARCHAR(255) NULL,
                scode3 VARCHAR(255) NULL,
                desc3 VARCHAR(255) NULL,
                unit3 VARCHAR(255) NULL,
                scode4 VARCHAR(255) NULL,
                desc4 VARCHAR(255) NULL,
                unit4 VARCHAR(255) NULL,
                scode5 VARCHAR(255) NULL,
                desc5 VARCHAR(255) NULL,
                unit5 VARCHAR(255) NULL,
                scode6 VARCHAR(255) NULL,
                desc6 VARCHAR(255) NULL,
                unit6 VARCHAR(255) NULL,
                scode7 VARCHAR(255) NULL,
                desc7 VARCHAR(255) NULL,
                unit7 VARCHAR(255) NULL,
                scode8 VARCHAR(255) NULL,
                desc8 VARCHAR(255) NULL,
                unit8 VARCHAR(255) NULL,
                scode9 VARCHAR(255) NULL,
                desc9 VARCHAR(255) NULL,
                unit9 VARCHAR(255) NULL,
                scode10 VARCHAR(255) NULL,
                desc10 VARCHAR(255) NULL,
                unit10 VARCHAR(255) NULL,
                scode11 VARCHAR(255) NULL,
                desc11 VARCHAR(255) NULL,
                unit11 VARCHAR(255) NULL,
                mt1 DECIMAL(10, 2) NOT NULL,
                ft1 DECIMAL(10, 2) NOT NULL,
                fg1 DECIMAL(10, 2) NOT NULL,
                mt2 DECIMAL(10, 2) NOT NULL,
                ft2 DECIMAL(10, 2) NOT NULL,
                fg2 DECIMAL(10, 2) NOT NULL,
                mt3 DECIMAL(10, 2) NOT NULL,
                ft3 DECIMAL(10, 2) NOT NULL,
                fg3 DECIMAL(10, 2) NOT NULL,
                mt4 DECIMAL(10, 2) NOT NULL,
                ft4 DECIMAL(10, 2) NOT NULL,
                fg4 DECIMAL(10, 2) NOT NULL,
                mt5 DECIMAL(10, 2) NOT NULL,
                ft5 DECIMAL(10, 2) NOT NULL,
                fg5 DECIMAL(10, 2) NOT NULL,
                mt6 DECIMAL(10, 2) NOT NULL,
                ft6 DECIMAL(10, 2) NOT NULL,
                fg6 DECIMAL(10, 2) NOT NULL,
                mt7 DECIMAL(10, 2) NOT NULL,
                ft7 DECIMAL(10, 2) NOT NULL,
                fg7 DECIMAL(10, 2) NOT NULL,
                mt8 DECIMAL(10, 2) NOT NULL,
                ft8 DECIMAL(10, 2) NOT NULL,
                fg8 DECIMAL(10, 2) NOT NULL,
                mt9 DECIMAL(10, 2) NOT NULL,
                ft9 DECIMAL(10, 2) NOT NULL,
                fg9 DECIMAL(10, 2) NOT NULL,
                mt10 DECIMAL(10, 2) NOT NULL,
                ft10 DECIMAL(10, 2) NOT NULL,
                fg10 DECIMAL(10, 2) NOT NULL,
                mt11 DECIMAL(10, 2) NOT NULL,
                ft11 DECIMAL(10, 2) NOT NULL,
                fg11 DECIMAL(10, 2) NOT NULL
            )";

            if ($con->query($createTableSQL) === TRUE) {
                $startRow = 1;
                $endRow = count($data) - 1;
                $batchSize = 100;

                for ($start = $startRow; $start <= $endRow; $start += $batchSize) {
                    $end = min($start + $batchSize - 1, $endRow);
        
                    mysqli_begin_transaction($con);
        
                    for ($row = $start; $row <= $end; $row++) {
                         
                       $sname = $data[$row][1];
                       $fname = $data[$row][2];
                       $mname = $data[$row][3];
                       $sno = $data[$row][5];
                       $sex = $data[$row][6];  
                       $course = $data[$row][7];
                       $year1 = $data[$row][8];
                       $section = $data[$row][9];
                       $status1 = $data[$row][10];
                       $semester = $data[$row][11];
                       $sy1 = $data[$row][12];
                       $sy2 = $data[$row][13];
                       $date= $data[$row][15];
                       
                       $scode1 = $data[$row][33];
                       $desc1 = $data[$row][34];
                       $unit1 = $data[$row][72];
           
                       $scode2 = $data[$row][37];
                       $desc2 = $data[$row][38];
                       $unit2 = $data[$row][73];
           
                       $scode3 = $data[$row][41];
                       $desc3 = $data[$row][42];
                       $unit3 = $data[$row][74];
           
                       $scode4 = $data[$row][45];
                       $desc4 = $data[$row][46];
                       $unit4 = $data[$row][75];
           
                       $scode5 = $data[$row][49];
                       $desc5 = $data[$row][50];
                       $unit5 = $data[$row][76];
           
                       $scode6 = $data[$row][53];
                       $desc6 = $data[$row][54];
                       $unit6 = $data[$row][77];
           
                       $scode7 = $data[$row][57];
                       $desc7 = $data[$row][58];
                       $unit7 = $data[$row][78];
           
                       $scode8 = $data[$row][61];
                       $desc8 = $data[$row][62];
                       $unit8 = $data[$row][79];
           
                       $scode9 = $data[$row][65];
                       $desc9 = $data[$row][66];
                       $unit9 = $data[$row][80];
           
                       $scode10 = $data[$row][69];
                       $desc10 = $data[$row][70];
                       $unit10 = $data[$row][81];
            

                        //$scode11 = $data[$row][73];
                        //$desc11 = $data[$row][74];
                        //$unit11 = $data[$row][83];
                        
                        $studentQuery = "INSERT INTO `$table_name` (sname, fname, mname, sno, sex, course, year1, section, status1, semester, sy1, sy2, date_enrol, scode1, desc1, unit1, scode2, desc2, unit2, scode3, desc3, unit3, scode4, desc4, unit4, scode5, desc5, unit5, scode6, desc6, unit6, scode7, desc7, unit7, scode8, desc8, unit8, scode9, desc9, unit9, scode10, desc10, unit10, scode11, desc11, unit11) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
                        $stmt = mysqli_prepare($con, $studentQuery);
                        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssssssssss", 
                        $sname, $fname, $mname, $sno, $sex, $course, $year1, $section, $status1, $semester, 
                        $sy1, $sy2, $date, $scode1, $desc1, $unit1, $scode2, $desc2, $unit2, $scode3, $desc3, 
                        $unit3, $scode4, $desc4, $unit4, $scode5, $desc5, $unit5, $scode6, $desc6, $unit6, $scode7, 
                        $desc7, $unit7, $scode8, $desc8, $unit8, $scode9, $desc9, $unit9, $scode10, $desc10, $unit10, 
                        $scode11, $desc11, $unit11);

                        $result = mysqli_stmt_execute($stmt);

                        if (!$result) {
                            mysqli_rollback($con);
                            echo "Error inserting row: " . mysqli_error($con);
                            break;
                        }
                
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_commit($con);
                    usleep(500000);
                }
                $_SESSION['table_name'] = $table_name;
                $_SESSION['message'] = "Successfully Imported";
                header('Location: studentdata.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Error creating table: " . $con->error;
                header('Location: studentdata.php');
                exit(0);
            }
        } else {
            $_SESSION['message'] = "No data found in the spreadsheet.";
            header('Location: studentdata.php');
            exit(0);
        }
    }
    catch (Exception $e) {
        $_SESSION['message'] = "Error importing file: " . $e->getMessage();
        header('Location: studentdata.php');
        exit(0);
    }
    } 
    else {
        $_SESSION['message'] = "Invalid File";
        header('Location: studentdata.php');
        exit(0);
    }
}
?>
