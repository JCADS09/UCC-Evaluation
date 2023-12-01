<?php
session_start();

include('connect/connection.php');

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $sql = mysqli_query($connect, "SELECT * FROM login WHERE Email = '$email'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $role_name = $fetch["roles"];

        // Generate a magic link token
        $magicLinkToken = bin2hex(random_bytes(32));

        // Store the magic link token and user's email in session
        $_SESSION['magic_link_token'] = $magicLinkToken;
        $_SESSION['magic_link_email'] = $email;

        require "register/Mail/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'ucc.evaluation@gmail.com';
        $mail->Password = 'wxzycycucnkutizo';

        $mail->setFrom('ucc.evaluation@gmail.com', 'OTP Verification');
        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);
        $mail->Subject = 'Login Confirmation';
        $magicLinkTokenEncoded = urlencode($magicLinkToken);
        $magicLink = 'http://localhost/UCC LANDING PAGE/login/magic_login.php?token=' . $magicLinkTokenEncoded;

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
            header("Location: login/magic_link_sent.php");
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

$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

// Fetch cdepartment values from the cdept table
$result = mysqli_query($con, "SELECT DISTINCT cdepartment FROM cdept");
if (!$result) {
    die("Query Error: " . mysqli_error($con));
}

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $cdepartment = $row['cdepartment'];
    $options .= "<option value='$cdepartment'>$cdepartment</option>";
}

mysqli_free_result($result);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-store">

    <meta http-equiv="x-content-type-options" content="nosniff">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn__SignUp__Landing__Page</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/app.css">
    <script src="login/modal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="#" method="POST" name="login" class="sign-in-form">
                    <h2 class="title">Sign In</h2>

                    <div class="input-field no-toggle">
                        <i for="email_address" class='bx bxs-user'></i>
                        <input type="email" id="email" name="email" placeholder="Username" required autofocus>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>

                    <button type="submit" value="Login" name="login" class="btn solid"
                        onclick="showDialog()">Login</button>
                </form>

                <form class="sign-up-form" action="register/register_action.php" method="POST">
                    <h2 class="title">Sign Up</h2>


                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="Firstname" name="Firstname" placeholder="First Name" required autofocus>
                    </div>

                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="Lastname" name="Lastname" placeholder="Last Name" required>
                    </div>

                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="Middlename" name="Middlename" placeholder="Middle Name" required
                            autofocus>
                    </div>

                    <div class="input-field">
                        <i class='bx bxs-envelope'></i>
                        <input type="text" id="Email" name="Email" placeholder="Email">
                    </div>

                    <!-- <div class="additional-input-field hidden">
                        <img src="images/add_pic.png" class="image clickable-image" alt="Click to upload"
                            id="profile-pic-preview">
                        <input type="file" name="profilepic" id="profilepic" accept="image/*" style="display: none;" />
                    </div> -->

                    <div class="additional-input-field hidden">
                        <div class="dropdown">
                            <label for="branch">College Department:</label>
                            <select id="branch" name="branch" onchange="populateCourses()">
                                <option value="" selected disabled>Select College Department</option>
                                <?php echo $options; ?>
                            </select>
                        </div>
                    </div>
                    <div class="additional-input-field hidden">
                        <div class="dropdown">
                            <label for="course">Course:</label>
                            <select name="course" id="courseDropdown">
                                <option value="" selected disabled>Please select College Department first</option>
                            </select>
                        </div>
                        <div id="additional-fields" style="display: none;"></div>
                    </div>

                    <div class="additional-input-field hidden">
                        <select name="roles" id="roles" placeholder="Role:">
                            <option value="MIS">MIS</option>
                            <option value="Coordinator">Coordinator</option>
                            <option value="Evaluator">Evaluator</option>
                            <option value="Vice President">Vice President</option>
                            <option value="Dean">Dean</option>
                            <option value="Head">Head</option>
                            <option value="Registrar">REGISTRAR</option>
                        </select>
                    </div>

                    <div class="additional-input-field hidden">
                        <select id="branch" name="branch" placeholder="Branch:">
                            <option value="CONGRESS">CONGRESS</option>
                            <option value="CAMARIN">CAMARIN</option>
                            <option value="BAGONG SILANG">BAGONG SILANG</option>
                            <option value="SOUTH">SOUTH</option>
                        </select>
                    </div>
                 
                    <button type="button" class="btn solid next-button">Next</button>
                    <input type="hidden" name="register" value="1">
                    
                   </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h1>UCC EVALUATION</h1>
                    <p>
                        This is the Evaluation System of University of Caloocan City. The purpose of the system is to
                        automate the current manual process of evalaution inside the organization.
                    </p>
                    <h3>New here?</h3><br>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="images/ucclogo.png" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h1>UCC EVALUATION</h1>
                    <p>
                        This is the Evaluation System of University of Caloocan City. The purpose of the system is to
                        automate the current manual process of evalaution inside the organization.
                    </p>
                    <h3>One of us?</h3><br>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="images/ucclogo.png" class="image" alt="">
            </div>
        </div>
    </div>
    <script>
        function populateCourses() {
            // Get the selected college department
            var selectedDepartment = document.getElementById("branch").value;

            // Fetch courses based on the selected department
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the JSON response
                    var courses = JSON.parse(this.responseText);

                    // Populate the courses dropdown
                    var courseDropdown = document.getElementById("courseDropdown");
                    courseDropdown.innerHTML = ""; // Clear existing options

                    // Add new options
                    for (var i = 0; i < courses.length; i++) {
                        var option = document.createElement("option");
                        option.value = courses[i].course;
                        option.text = courses[i].course;
                        courseDropdown.appendChild(option);
                    }
                }
            };

            // Send an AJAX request to fetch courses for the selected department
            xhttp.open("GET", "get_courses.php?department=" + selectedDepartment, true);
            xhttp.send();
        }
    </script>
    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".next-button").click(function (e) {
                e.preventDefault();
                console.log("Button clicked");

                var buttonText = $(this).text();

                if (buttonText === "Next") {
                    $(this).text("Submit");
                } else {
                    $(".sign-up-form").submit();
                }
                  // Toggle visibility of elements
                $(".input-field:not(.no-toggle)").toggleClass("hidden");
                $(".additional-input-field").toggleClass("hidden");

            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const clickableImage = document.querySelector(".clickable-image");
            const fileInput = document.getElementById("profilepic");
            const profilePicPreview = document.getElementById("profile-pic-preview");

            clickableImage.addEventListener("click", function () {
                fileInput.click(); // Trigger the click event on the file input
            });

            fileInput.addEventListener("change", function () {
                const selectedFile = fileInput.files[0];

                if (selectedFile) {
                    // Create a URL for the selected image
                    const imageURL = URL.createObjectURL(selectedFile);

                    // Update the src attribute of the image to display the selected image
                    profilePicPreview.src = imageURL;
                    profilePicPreview.style.borderRadius = "50%";
                    profilePicPreview.style.width = "150px";
                    profilePicPreview.style.height = "150px";
                }
            });
        });
    </script>

</body>

</html>