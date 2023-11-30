<?php
session_start();
  $page_title = 'Add User';
  include('../connect/connection.php');
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Verification</title>
</head>
<STYle>
    .otp-Form {
  width: 230px;
  height: 300px;
  background-color: rgb(255, 255, 255);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px 30px;
  gap: 20px;
  position: relative;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.082);
  border-radius: 15px;
}

.mainHeading {
  font-size: 1.1em;
  color: rgb(15, 15, 15);
  font-weight: 700;
}

.otpSubheading {
  font-size: 0.7em;
  color: black;
  line-height: 17px;
  text-align: center;
}

.inputContainer {
  width: 100%;
  display: flex;
  flex-direction: row;
  gap: 10px;
  align-items: center;
  justify-content: center;
}

.otp-input {
  background-color: rgb(228, 228, 228);
  width: 30px;
  height: 30px;
  text-align: center;
  border: none;
  border-radius: 7px;
  caret-color: rgb(127, 129, 255);
  color: rgb(44, 44, 44);
  outline: none;
  font-weight: 600;
}

.otp-input:focus,
.otp-input:valid {
  background-color: rgba(127, 129, 255, 0.199);
  transition-duration: .3s;
}

.verifyButton {
  width: 100%;
  height: 30px;
  border: none;
  background-color: rgb(127, 129, 255);
  color: white;
  font-weight: 600;
  cursor: pointer;
  border-radius: 10px;
  transition-duration: .2s;
}

.verifyButton:hover {
  background-color: rgb(144, 145, 255);
  transition-duration: .2s;
}

.exitBtn {
  position: absolute;
  top: 5px;
  right: 5px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.171);
  background-color: rgb(255, 255, 255);
  border-radius: 50%;
  width: 25px;
  height: 25px;
  border: none;
  color: black;
  font-size: 1.1em;
  cursor: pointer;
}

.resendNote {
  font-size: 0.7em;
  color: black;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 5px;
}

.resendBtn {
  background-color: transparent;
  border: none;
  color: rgb(127, 129, 255);
  cursor: pointer;
  font-size: 1.1em;
  font-weight: 700;
}
</STYle>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verification Account</div>
                    <div class="card-body">
                        <span class="mainHeading">Enter OTP</span>
                        <p class="otpSubheading">We have sent a verification code to your mobile number</p>
                        <form action="#" method="POST">
                        <div class="inputContainer">
                        <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input1">
                        <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input2">
                        <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input3">
                        <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input4"> 
                        <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input5">
                        <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input6"> 
                        
                        </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="hidden" id="otp" class="form-control" name="otp_code" >
                                </div>
                            </div>

                        <button class="verifyButton" type="submit" value="Verify" name="verify">Verify</button>
                            <button class="exitBtn">×</button>
                            <p class="resendNote">Didn't receive the code? <button class="resendBtn">Resend Code</button></p>
                             </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
<script>
    $(document).ready(function () {
        $('.otp-input').on('input', function () {
            var otpValue = $('#otp-input1').val() +
                            $('#otp-input2').val() +
                            $('#otp-input3').val() +
                            $('#otp-input4').val() +
                            $('#otp-input5').val() +
                            $('#otp-input6').val();
            $('#otp').val(otpValue);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.otp-input').on('input', function () {
            var currentId = $(this).attr('id');
            var currentNumber = parseInt(currentId.match(/\d+/)[0]);
            if (currentNumber < 6) {
                var nextId = '#otp-input' + (currentNumber + 1);
                $(nextId).focus();
            }
        });
    });
</script>
</body>
</html>
<?php 
   include('../connect/connection.php');
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
            $query = "UPDATE login SET verified = 1 WHERE email = '$email'";
            if (mysqli_query($connect, $query)) {
                ?>
                <script>
                    alert("Verify account done, you may sign in now");
                    window.location.replace("../index.php");
                </script>
                <?php
            } else {
                echo "Error updating record: " . mysqli_error($connect);
            }
        }

    }

?>