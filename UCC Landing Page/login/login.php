<?php
session_start(); 

include('../connect/connection.php');

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));

    $sql = mysqli_query($connect, "SELECT * FROM login WHERE email = '$email'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $role_name = $fetch["roles"];

      
        $magicLinkToken = bin2hex(random_bytes(32));

     
        $_SESSION['magic_link_token'] = $magicLinkToken;
        $_SESSION['magic_link_email'] = $email;

        require "../register/Mail/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='ucc.evaluation@gmail.com';
        $mail->Password='wxzycycucnkutizo';

        $mail->setFrom('ucc.evaluation@gmail.com', 'OTP Verification');
        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);
        $mail->Subject = 'Login Confirmation';
        $magicLinkTokenEncoded = urlencode($magicLinkToken); 
        $magicLink = 'http://localhost/UCC%20Evaluation%20System/login-register/login/magic_login.php?token=' . $magicLinkTokenEncoded;

        $mail->Body = "<b>Dear User</b>
            <h3>Click the following link to log in:</h3>
            <a href='$magicLink'>Login</a>";

        if (!$mail->send()) {
            ?>
            <script>
                alert("An error occurred while sending the magic link. Please try again later.");
            </script>
            <?php
          
            error_log("Magic link email sending error: " . $mail->ErrorInfo);
        } else {
           
            header("Location: magic_link_sent.php");
            exit();
        }
    } else {
        ?>
        <script>
            alert("Email not found. Please try again.");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
</head>
<body class="bg">

<link rel="stylesheet" href="style.css"> 
<div class="wrappe">
    <div class="form-box login">
    <form action="#" method="POST" name="login">
        <div class="h">
        <img src="images/header_v2.png"></img>
        </div>

        <div class="input-box">
        <label for="email_address" class="lbl">Username</label><br>
        <input type="email" id="email" name="email" required autofocus>
        </div>
        
        <div  class="try"><input type="checkbox" name="remember"><a class="remme">Remember me</a></div>
        <input type="submit" value="Login" name="login" class="LOGIN">
       
        <div class="link">
        <a href="../register/register.php" class="register-link"> Create Account </a> <a class="space">|</a>
        <a href="../recover_psw.php" class="forget-pass"> Forget Password?</a>
        </div> 
    </form>
</div>

</body>
</html>
