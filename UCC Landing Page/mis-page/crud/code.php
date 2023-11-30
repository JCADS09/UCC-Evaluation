<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM login WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Account Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Account Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_POST['update_student'])) {
    echo "Received POST data: " . json_encode($_POST);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    // Use isset to check if the key 'account_status' is present in the POST data
    $account_status = isset($_POST['account_status']) ? ($_POST['account_status'] == 1 ? 1 : 0) : 0;

    // Add an echo statement for debugging
    echo 'Account Status:', $account_status, '<br>';

    $query = "UPDATE login SET first_name='$name', email='$email', roles='$phone', branch='$course', account_status='$account_status' WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Account Updated Successfully." . PHP_EOL . "Account Status: " . $account_status;

        header('Location: index.php');
        exit();
    } else {
        $_SESSION['message'] = "Account Not Updated";
        header('Location: student-edit.php?id=' . $student_id);
        exit();
    }
}





if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $query = "INSERT INTO students (name,email,phone,course) VALUES ('$name','$email','$phone','$course')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

?>