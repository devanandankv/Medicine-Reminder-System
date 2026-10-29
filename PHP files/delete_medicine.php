<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM medicines WHERE id='$id'";

if(mysqli_query($conn, $sql))
{
    header("Location: view_medicines.php");
}
else
{
    echo "Delete Failed!";
}
?>