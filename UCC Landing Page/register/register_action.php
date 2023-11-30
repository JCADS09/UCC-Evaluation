<?php
session_start();
include('../connect/connection.php');

if (isset($_POST["register"])) {
    $first_name = $_POST["Firstname"];
    $last_name = $_POST["Lastname"];
    $middle_name = $_POST["Middlename"];
    $roles = $_POST["roles"];
    $branch = $_POST["branch"];
    $email = $_POST["Email"];
    
    // Check if the 'profilepic' key exists in $_FILES array
    if (isset($_FILES['profilepic'])) {
        $file_name = $_FILES['profilepic']['name'];
        $file_tmp = $_FILES['profilepic']['tmp_name'];
        $file_type = $_FILES['profilepic']['type'];
        
        $upload_directory = 'uploads/';
        $target_file = $upload_directory . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $result = mysqli_query($connect, "INSERT INTO login (first_name, last_name, middle_name, roles, branch, email, account_status) VALUES ('$first_name', '$last_name', '$middle_name', '$roles', '$branch', '$email', 0)");
            
            if ($result) {
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
                $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3><br><br>";
                
                if(!$mail->send()){
                    ?>
                    <script>
                        alert("<?php echo "Register Failed, Invalid Email "?>");
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                        window.location.replace('verification.php');
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    alert("Error: Unable to register. Please try again later.");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Error: Failed to upload profile picture.");
            </script>
            <?php
        }
    } else {
        // Handle the case when 'profilepic' key is not set (profile picture not provided)
        $result = mysqli_query($connect, "INSERT INTO login (first_name, last_name, middle_name, roles, branch, email, account_status) VALUES ('$first_name', '$last_name', '$middle_name', '$roles', '$branch', '$email', 0)");

        if ($result) {
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
            $mail->Subject="Your OTP Verification";
            $mail->Body="<h2>Dear $last_name, </h2><h1>Welcome to UCC Evaluation System</h1><h3>$otp  is your OTP. <p>For your Protection,do not share this link with anyone.<p>  <br></h3><br><br>";
            
            if(!$mail->send()){
                ?>
                <script>
                    alert("<?php echo "Register Failed, Invalid Email "?>");
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                    window.location.replace('verification.php');
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Error: Unable to register. Please try again later.");
            </script>
            <?php
        }
    }
}
?>
