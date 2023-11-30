<!DOCTYPE html>
<html  class="container">
<head>
    <title>Verification Status</title>
    <meta charset="UTF-8">

</head>
<style>body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; 
  margin: 0; 
}
.container {
  width: 100%;
  height: 100%;
  background-image: radial-gradient(circle, orange, transparent 20%, orangered);
  background-size: cover;
  background-repeat: no-repeat;
  background-color: orange;
}

.notifications-container {
  width: 320px;
  height: auto;
  font-size: 0.875rem;
  line-height: 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.flex {
  display: flex;
}

.flex-shrink-0 {
  flex-shrink: 0;
}

.success {
  padding: 1rem;
  border-radius: 0.375rem;
  background-color: rgb(240 253 244);
}

.succes-svg {
  color: rgb(74 222 128);
  width: 1.25rem;
  height: 1.25rem;
}

.success-prompt-wrap {
  margin-left: 0.75rem;
}

.success-prompt-heading {
  font-weight: bold;
  color: rgb(22 101 52);
}

.success-prompt-prompt {
  margin-top: 0.5rem;
  color: rgb(21 128 61);
}

.success-button-container {
  display: flex;
  margin-top: 0.875rem;
  margin-bottom: -0.375rem;
  margin-left: -0.5rem;
  margin-right: -0.5rem;
}

.success-button-main {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  background-color: #ECFDF5;
  color: rgb(22 101 52);
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: bold;
  border-radius: 0.375rem;
  border: none
}

.success-button-main:hover {
  background-color: #D1FAE5;
}

.success-button-secondary {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  margin-left: 0.75rem;
  background-color: #ECFDF5;
  color: #065F46;
  font-size: 0.875rem;
  line-height: 1.25rem;
  border-radius: 0.375rem;
  border: none;
}

</style>
<body >
<div class="notifications-container">
  <div class="success">
    <div class="flex">
      <div class="flex-shrink-0">
        
        <svg class="succes-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <div class="success-prompt-wrap">
        <p class="success-prompt-heading">Verification Status
        <div class="success-prompt-prompt">
        <?php
        session_start();

        if (isset($_GET['token']) && isset($_SESSION['magic_link_token']) && $_SESSION['magic_link_token'] === $_GET['token']) {
          
            $userEmail = $_SESSION['magic_link_email'];
            
            include('../connect/connection.php');
            
            $updateQuery = "UPDATE login SET account_status = 1 WHERE Email = ?";
            $stmt = mysqli_prepare($connect, $updateQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $userEmail);
                if (mysqli_stmt_execute($stmt)) {
                    echo '<p class="success-prompt-prompt">Verification successful! You can now log in.</p>';
                } else {
                    echo '<p class="success-prompt-prompt">Error: Unable to verify your account. Please try again later.</p>';
                }
            } else {
                echo '<p class="success-prompt-prompt">Error: Database error. Please try again later.</p>';
            }

            mysqli_stmt_close($stmt);
            mysqli_close($connect);   
        } else {
            echo "Invalid or expired token.";
        }
        ?>
        </div>
        <div class="success-button-container">
            <button type="button" class="success-button-main">View status</button>
            <button type="button" class="success-button-secondary">Dismiss</button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</body>
</html>
