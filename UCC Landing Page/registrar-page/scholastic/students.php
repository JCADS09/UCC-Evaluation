

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <style>
        .panel-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
            border-radius: 5px; 
            background-color: #fff; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 13px;
        }

        table th, table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        table thead {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #ddd;
        }

        .btnView{
            display: inline-block;
            padding: 10px 20px;
            background-color: #099c02;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btnView:hover {
            background-color: #0f9136;
        }
    </style>
</head>
<body>
    <?php
include '../db.php';
$query = "SELECT sno, CONCAT(sname, ', ', fname, ' ', mname) AS Name, course, year1 AS year, section AS section, status1 AS status FROM 202220231stsemcongress";
$result = mysqli_query($con, $query);
?>
    <div class="panel-container">
        <table id="students" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Student No</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . $row['sno'] . '</td>';
                    echo '<td>' . $row['Name'] . '</td>';
                    echo '<td>' . $row['course'] . '</td>';
                    echo '<td>' . $row['year'] . '</td>';
                    echo '<td>' . $row['section'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td><center><a class="btnView" href="scholastic.php?id=' . $row['sno'] . '"> View Records </a></center></td>';
                    echo '</tr>';
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <script type="text/javascript">
        $(document).ready(function() {
            $('#students').DataTable({
                responsive: true
            });
        });
    </script>
</body>
</html>
