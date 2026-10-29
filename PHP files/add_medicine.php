<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$message="";

if(isset($_POST['save']))
{

$user_id=$_SESSION['user_id'];

$medicine_name=$_POST['medicine_name'];

$dosage=$_POST['dosage'];

$reminder_time=$_POST['reminder_time'];

$start_date=$_POST['start_date'];

$end_date=$_POST['end_date'];

$sql="INSERT INTO medicines(user_id,medicine_name,dosage,reminder_time,start_date,end_date)

VALUES('$user_id','$medicine_name','$dosage','$reminder_time','$start_date','$end_date')";

if(mysqli_query($conn,$sql))
{
$message="Medicine Added Successfully!";
}
else
{
$message="Failed!";
}

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Add Medicine</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h1>Add Medicine</h1>

<p style="color:green;"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="medicine_name" placeholder="Medicine Name" required>

<input type="text" name="dosage" placeholder="Dosage (Eg: 1 Tablet)" required>

<input type="time" name="reminder_time" required>

<input type="date" name="start_date" required>

<input type="date" name="end_date" required>

<input type="submit" name="save" value="Save Medicine">

</form>

<br>

<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>

</html>