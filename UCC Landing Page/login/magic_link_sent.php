<?php
session_start();

$role_name = '';
$authenticated = false;
$name = $_SESSION["name"];
$userEmail = $_SESSION['magic_link_email'];
include('../connect/connection.php');

// Assuming you have retrieved the verification status from the database
$query = "SELECT verified, roles FROM login WHERE email = ?";
$stmt = mysqli_prepare($connect, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_bind_result($stmt, $databaseVerified, $userRoles);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_fetch($stmt)) {
        $role_name = $userRoles;
        $authenticated = true;

        // Set $_SESSION["verified"] based on the database value
        $_SESSION["verified"] = ($databaseVerified == 1) ? 1 : 0;
    } else {
        echo "User not found or has no roles.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing the SQL statement.";
}

$sql = "SELECT * FROM login WHERE email = '$userEmail'";
$result = mysqli_query($connect, $sql);

if ($authenticated && $result) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION["email"] = $user["email"];
    $_SESSION["roles"] = $user["roles"];
    $_SESSION["branch"] = $user["branch"];
    $_SESSION["name"] = $user["last_name"] . ' ' . $user["first_name"];
    $_SESSION["profile_pic"] = $user["profile_pic"];
}

mysqli_close($connect);

// Capture output buffer
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Magic Link Sent</title>
    <meta charset="UTF-8">
</head>
<style>
 body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.5), 0 1px 10px 6px rgba(0, 0, 0, 0.7);
            background: url('images/background.PNG') center/cover no-repeat;
        }
        body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8); /* Adjust the alpha value for the tint effect */
    z-index: -1;
}
        .cookie-card {
            max-width: 320px;
            padding: 1rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 20px 20px 30px rgba(0, 0, 0, .05);
            z-index: 90;
            /* existing styles */
            margin: auto;
        }

        .title {
            font-weight: 600;
            color: rgb(31 41 55);
        }

.description {
  margin-top: 1rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: rgb(75 85 99);
}

.description a {
  --tw-text-opacity: 1;
  color: rgb(59 130 246);
}

.description a:hover {
  -webkit-text-decoration-line: underline;
  text-decoration-line: underline;
}

.actions {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 1rem;
  -moz-column-gap: 1rem;
  column-gap: 1rem;
  flex-shrink: 0;
}

.pref {
  font-size: 0.75rem;
  line-height: 1rem;
  color: rgb(31 41 55 );
  -webkit-text-decoration-line: underline;
  text-decoration-line: underline;
  transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
  border: none;
  background-color: transparent;
}

.pref:hover {
  color: rgb(156 163 175);
}

.pref:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.accept {
  font-size: 0.75rem;
  line-height: 1rem;
  background-color: rgb(17 24 39);
  font-weight: 500;
  border-radius: 0.5rem;
  color: #fff;
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.625rem;
  padding-bottom: 0.625rem;
  border: none;
  transition: all .15s cubic-bezier(0.4, 0, 0.2, 1);
}

.accept:hover {
  background-color: rgb(55 65 81);
}

.accept:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}
.loader {
  position: relative;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.jimu-primary-loading:before,
.jimu-primary-loading:after {
  position: absolute;
  top: 0;
  content: '';
}

.jimu-primary-loading:before {
  left: -19.992px;
}

.jimu-primary-loading:after {
  left: 19.992px;
  -webkit-animation-delay: 0.32s !important;
  animation-delay: 0.32s !important;
}

.jimu-primary-loading:before,
.jimu-primary-loading:after,
.jimu-primary-loading {
  background: #076fe5;
  -webkit-animation: loading-keys-app-loading 0.8s infinite ease-in-out;
  animation: loading-keys-app-loading 0.8s infinite ease-in-out;
  width: 13.6px;
  height: 32px;
}

.jimu-primary-loading {
  text-indent: -9999em;
  margin: auto;
  position: absolute;
  right: calc(50% - 6.8px);
  top: calc(50% - 16px);
  -webkit-animation-delay: 0.16s !important;
  animation-delay: 0.16s !important;
}

@-webkit-keyframes loading-keys-app-loading {

  0%,
  80%,
  100% {
    opacity: .75;
    box-shadow: 0 0 #076fe5;
    height: 32px;
  }

  40% {
    opacity: 1;
    box-shadow: 0 -8px #076fe5;
    height: 40px;
  }
}

@keyframes loading-keys-app-loading {

  0%,
  80%,
  100% {
    opacity: .75;
    box-shadow: 0 0 #076fe5;
    height: 32px;
  }

  40% {
    opacity: 1;
    box-shadow: 0 -8px #076fe5;
    height: 40px;
  }
}

button {
    padding: 0.8em 1.8em;
    border: 2px solid #17C3B2;
    position: relative;
    overflow: hidden;
    background-color: transparent;
    text-align: center;
    text-transform: uppercase;
    font-size: 16px;
    transition: .3s;
    z-index: 1;
    font-family: inherit;
    color: #17C3B2;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1rem; /* Add margin for spacing */
}

button::before {
    content: '';
    width: 0;
    height: 300%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
    background: #17C3B2;
    transition: .5s ease;
    display: block;
    z-index: -1;
}

button:hover::before {
    width: 105%;
}

button:hover {
    color: #111;
}
</style>
<body>
<div class="cookie-card">
    <span class="title"> Login Confirmation</span>
    <p class="description"><?php
        if ($authenticated) {
            echo "<p>Welcome to UCC Evaluation System.<br>

            Hey, $name!<br>
            We've sent a confirmation link to your email account.<br>
            Please check it. Thank you</p>";
        }
        ?>
      <div id="timer">Redirecting in 60 seconds...</div>
      <?php echo "Role Name: " . $role_name; ?>
      <br><br>
    <div class="loader">
    <div class="justify-content-center jimu-primary-loading"></div>
    </div>
    <div class="actions">
    <button class="continue" onclick="checkVerification()">
        Continue
    </button>
</div>
    </div>
</div>


    
    
   
<?php
$isVerified = isset($_SESSION["verified"]) ? $_SESSION["verified"] : 0; // Set a default value if "verified" key is not set
?>
      <script>
          var count = 60;
          var timerElement = document.getElementById("timer");

          var role = "<?php echo $role_name; ?>";
          function checkVerification() {
        if (isVerified === 1) {
          if (role === '') {
                      window.location.href = "../index.php";
                  } else if (role === 'MIS') {
                      window.location.href = "../misnav.php";
                  } else if (role === 'COORDINATOR') {
                      window.location.href = "../coornav.php";
                  } else if (role === 'EVALUATOR') {
                      window.location.href = "../evaluatornav.php";
                  } else if (role === 'REGISTRAR') {
                      window.location.href = "../registrarnav.php";
                  } else if (role === 'DEAN'||role === 'HEAD') {
                      window.location.href = "../deptheadnav.php";
                  } else {
                      window.location.href = "../index.php";
                  }
        } else {
          updateTimer();
          
        }
    }
          function updateTimer() {
              timerElement.textContent = "Redirecting in " + count + " seconds...";
              if (count <= 0) {
                  
                  if (role === '') {
                      window.location.href = "../index.php";
                  } else if (role === 'MIS') {
                      window.location.href = "../misnav.php";
                  } else if (role === 'COORDINATOR') {
                      window.location.href = "../coornav.php";
                  } else if (role === 'EVALUATOR') {
                      window.location.href = "../evaluatornav.php";
                  } else if (role === 'REGISTRAR') {
                      window.location.href = "../registrarnav.php";
                  } else if (role === 'DEAN'||role === 'HEAD') {
                      window.location.href = "../deptheadnav.php";
                  } else {
                      window.location.href = "../index.php";
                  }
              } else {
                  count--;
                  setTimeout(updateTimer, 1000);
              }
          }

          updateTimer();
      </script>
</body>
</html>
<?php




