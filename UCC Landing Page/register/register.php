<?php session_start(); ?>
<?php
    include('connect/connection.php');

    if(isset($_POST["register"])){
        $first_name = $_POST["Firstname"];
        $last_name = $_POST["Lastname"];
        $middle_name = $_POST["Middlename"];
        $roles = $_POST["roles"];
        $branch = $_POST["branch"];
        $email = $_POST["Email"];
        $password = $_POST["Password"];
        $c_password = $_POST["CPassword"];

        $check_query = mysqli_query($connect, "SELECT * FROM login where Email ='$email'");
        $rowCount = mysqli_num_rows($check_query);

        if($password == $c_password){
            if($rowCount > 0){
                ?>
                <script>
                    alert("User with email already exist!");
                </script>
                <?php
            }                      
            else{
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                $result = mysqli_query($connect, "INSERT INTO login (first_name, last_name, middle_name, roles, branch, email, password_hash, account_status) VALUES ('$first_name', '$last_name', '$middle_name', '$roles', '$branch', '$email', '$password_hash', 0)");

                if($result){
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
                    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='ucc.evaluation@gmail.com';
                    $mail->Password='wxzycycucnkutizo';
    
                    $mail->setFrom('ucc.evaluation@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["Email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your verify code";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    
                    ";
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "Register Failed, Invalid Email "?>");
                                    </script>
                                <?php
                            }else{
                                ?>
                                <script>
                                    alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                    window.location.replace('../verification.php');
                                </script>
                                <?php
                            }
                }
            }
        }
        else {
            ?>
                <script>
                    alert("Password Does Not Match!!");
                </script>
                <?php
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">

    <title>Register Form</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Register Form</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php" >Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php" style="font-weight:bold; color:black; text-decoration:underline">Register</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<form action="#" method="POST" name="register">
<body class="bg">
        <link rel="stylesheet" href="style.css"> 

        <div class="wrappe">
            <div class="form-box login">
            <form action="#" method="POST" name="register">
                <div class="h">
                <img src="images/header_v2.png"></img>
                </div>
        
                <div class="input-box">
                <label for="first_name" class="lbl">First Name</label><br>
                <input type="text" id="Firstname" name="Firstname" required autofocus>
                </div>
        
                <div class="input-box">
                <label for="last_name" class="lbl">Last Name</label><br>
                <input type="text" id="Lastname"  name="Lastname" required>  
                </div> 

                <div class="input-box">
                <label for="middle_name" class="lbl">Middle Name</label><br>
                <input type="text" id="Middlename" name="Middlename" required autofocus>
                </div> 
                
              
          
                <div>
                <label for="roles">Choose Your Role:</label>
                    <select name="roles" id="roles">
                        <option value="MIS">MIS</option>
                        <option value="Coordinator">Coordinator</option>
                        <option value="Evaluator">Evaluator</option>
                        <option value="Vice President">Vice President</option>
                        <option value="Dean">Dean</option>
                        <option value="Head">Head</option>
                    </select>
                </div>

                <div>
                <label for="branch" >Branch</label>
                    <select id="branch" name="branch">
                        <option value="CONGRESS">CONGRESS</option>
                        <option value="CAMARIN">CAMARIN</option>
                        <option value="BAGONG SILANG">BAGONG SILANG</option>
                        <option value="SOUTH">SOUTH</option>
                    </select>
                </div>

                <div class="input-box">
                <label for="email_address" class="lbl">E-Mail Address</label><br>
                <input type="email" id="Email" name="Email" required autofocus>
                </div> 
                
                <div class="link">
                <a href="../login/login.php" class="register-link"> Signin Account </a> 
                </div> 
         
                <div>
                <input type="submit" value="Register" name="register" class="LOGIN">
                </div>

            </form>
        </div>
        </body>                        
</html>
