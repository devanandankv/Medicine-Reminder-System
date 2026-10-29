<?php
date_default_timezone_set('Asia/Kolkata');

session_start();
include "config.php";

if(!isset($_SESSION['user_id']))
{
    exit();
}

$user_id = $_SESSION['user_id'];

$current_time = date("H:i");

$sql = "SELECT * FROM medicines
        WHERE user_id='$user_id'
        AND TIME_FORMAT(reminder_time,'%H:%i')='$current_time'";

$result = mysqli_query($conn, $sql);

$medicines = [];

while($row = mysqli_fetch_assoc($result))
{
    $medicines[] = $row;
}

header('Content-Type: application/json');
echo json_encode($medicines);
?>