

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>EVALUATE</title>
</head>
<body>
    <?php
    include 'db.php';
    $id = $_GET['id'];
    $sql=  mysqli_query($con, "SELECT * FROM students where sno = '$id' ");
    while($row = mysqli_fetch_assoc($sql)) {
    ?>
          <h1 class="page-header"><?php echo $row['sname'] . ', ' . $row['fname']. ' ' . $row['mname'] ?></h1>
          <?php
    } mysqli_close($con);
      ?>
</body>
</html>