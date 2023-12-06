<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uccevaluation";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = isset($_SESSION["name"]) ? $_SESSION["name"] : "";

function renderDropdown($name) {
    echo '<div class="dropdown">
            <button class="dropbtn">
                ' . $name . ' &nbsp; ▼
            </button>
            <div class="dropdown-content">
                <a href="">Notification</a>
                <a id="top" href="#">Activity Log</a>
                <a id="middle" href="#">Account Settings</a>
                <form method="POST" action="index.php" onsubmit="return submitForm(this);">
                    
                <input type="submit" value="Logout" />
                </form>
            </div>
          </div>';
}
?>


<script src="sweetalert.js"></script>



<script>
    function submitForm(form) {
        swal({
            title: "Are you sure?",
            text: "This form will be submitted",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then(function (isOkay) {
            if (isOkay) {
                form.submit();
            }
        });
        return false;
    }
</script>
