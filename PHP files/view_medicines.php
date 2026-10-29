<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM medicines WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Medicines</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container" style="width:90%; max-width:1000px;">

<h1>My Medicines</h1>

<table border="1" width="100%" cellpadding="10" cellspacing="0">

<tr>
    <th>Medicine</th>
    <th>Dosage</th>
    <th>Time</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Action</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['medicine_name']; ?></td>

<td><?php echo $row['dosage']; ?></td>

<td><?php echo $row['reminder_time']; ?></td>

<td><?php echo $row['start_date']; ?></td>

<td><?php echo $row['end_date']; ?></td>

<td>
    <a href="edit_medicine.php?id=<?php echo $row['id']; ?>">✏ Edit</a> |
    <a href="delete_medicine.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this medicine?')">🗑 Delete</a>
</td>

</tr>

<?php
}
?>

</table>

<br>

<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>