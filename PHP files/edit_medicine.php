<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM medicines WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $medicine_name = $_POST['medicine_name'];
    $dosage = $_POST['dosage'];
    $reminder_time = $_POST['reminder_time'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $update = "UPDATE medicines SET
    medicine_name='$medicine_name',
    dosage='$dosage',
    reminder_time='$reminder_time',
    start_date='$start_date',
    end_date='$end_date'
    WHERE id='$id'";

    if(mysqli_query($conn, $update))
    {
        header("Location: view_medicines.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Medicine</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h1>Edit Medicine</h1>

<form method="POST">

<input type="text"
name="medicine_name"
value="<?php echo $row['medicine_name']; ?>"
required>

<input type="text"
name="dosage"
value="<?php echo $row['dosage']; ?>"
required>

<input type="time"
name="reminder_time"
value="<?php echo $row['reminder_time']; ?>"
required>

<input type="date"
name="start_date"
value="<?php echo $row['start_date']; ?>"
required>

<input type="date"
name="end_date"
value="<?php echo $row['end_date']; ?>"
required>

<input type="submit"
name="update"
value="Update Medicine">

</form>

<br>

<a href="view_medicines.php">⬅ Back</a>

</div>

</body>
</html>