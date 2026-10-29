<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['token'])) {

    $token = mysqli_real_escape_string($conn, $_POST['token']);

    $sql = "UPDATE users
            SET fcm_token='$token'
            WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>