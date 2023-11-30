<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <title>Student Edit</title>
</head>
<style>.switch {
 position: relative;
 display: inline-block;
 width: 120px;
 height: 34px;
}

.switch input {
 display: none;
}

.slider {
 position: absolute;
 cursor: pointer;
 top: 0;
 left: 0;
 right: 0;
 bottom: 0;
 background-color: #3C3C3C;
 -webkit-transition: .4s;
 transition: .4s;
 border-radius: 34px;
}

.slider:before {
 position: absolute;
 content: "";
 height: 26px;
 width: 26px;
 left: 4px;
 bottom: 4px;
 background-color: white;
 -webkit-transition: .4s;
 transition: .4s;
 border-radius: 50%;
}

input:checked + .slider {
 background-color: #0E6EB8;
}

input:focus + .slider {
 box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
 -webkit-transform: translateX(26px);
 -ms-transform: translateX(26px);
 transform: translateX(85px);
}

/*------ ADDED CSS ---------*/
.slider:after {
 content: 'DISABLED';
 color: white;
 display: block;
 position: absolute;
 transform: translate(-50%,-50%);
 top: 50%;
 left: 50%;
 font-size: 10px;
 font-family: Verdana, sans-serif;
}

input:checked + .slider:after {
 content: 'ENABLED';
}

/*--------- END --------*/
</style>
<body>
  
<div class="header-top-area" style="background-color: rgb(17, 112, 22);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="logo-area" style="display: flex; align-items: center;">
                                <img src="../../system-img/check.png" width="45" height="45"> 
                                <span style="color: white; font-weight: bold; font-size: 24px; margin-left: 10px;">UCC EVALUATION</span>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="header-top-menu">
                                <ul class="nav navbar-nav notika-top-nav">
                                    <li class="nav-item dropdown">      
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Account
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM login WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?=$student['first_name'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$student['email'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Role</label>
                                        <input type="text" name="phone" value="<?=$student['roles'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Branch</label>
                                        <input type="text" name="course" value="<?=$student['branch'];?>" class="form-control">
                                    </div>
                                    
                                    <div>
    <input type="hidden" name="account_status" value="0">
    <label class="switch" for="toggle<?= $student['id']; ?>">
        <input type="checkbox" name="toggle_switch" id="toggle<?= $student['id']; ?>" <?php echo $student['account_status'] == 1 ? 'checked' : ''; ?> style="display: none;">
        <span class="slider"></span>
    </label>
</div>

                                       
                                               
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            Update Student
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#toggle<?= $student['id']; ?>').change(function () {
            var isToggleChecked = $(this).is(':checked');
            var accountStatusValue = isToggleChecked ? 1 : 0;

            $('input[name="account_status"]').val(accountStatusValue);
            console.log(accountStatusValue); // Add this line for debugging

            // Continue with the rest of your code...
        });
    });
</script>


</body>

</html>