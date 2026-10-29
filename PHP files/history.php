<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT * FROM medicines WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicine History</title>
    <link rel="stylesheet" href="css/style.css">

    <style>

    .history-table{
        width:100%;
        border-collapse:collapse;
        margin-top:20px;
        overflow:hidden;
        border-radius:15px;
    }

    .history-table th{
        background:#0077b6;
        color:white;
        padding:15px;
        font-size:16px;
    }

    .history-table td{
        padding:12px;
        text-align:center;
        color:#333;
        background:rgba(255,255,255,0.9);
    }

    .history-table tr:nth-child(even){
        background:#f4f9ff;
    }

    .history-table tr:hover td{
        background:#dff6ff;
        transition:.3s;
    }

    .back-btn{
        display:inline-block;
        margin-top:20px;
        padding:12px 25px;
        background:#0077b6;
        color:white;
        text-decoration:none;
        border-radius:10px;
        transition:.3s;
    }

    .back-btn:hover{
        background:#023e8a;
        transform:translateY(-2px);
    }

    h1{
        margin-bottom:20px;
    }

    </style>

</head>

<body>

<div class="container" style="width:90%; max-width:1100px;">

    <h1>📜 Medicine History</h1>

    <table class="history-table">

        <tr>
            <th>💊 Medicine</th>
            <th>💉 Dosage</th>
            <th>⏰ Time</th>
            <th>📅 Start Date</th>
            <th>📅 End Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['medicine_name']; ?></td>
            <td><?php echo $row['dosage']; ?></td>
            <td><?php echo date("h:i A", strtotime($row['reminder_time'])); ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
        </tr>

        <?php } ?>

    </table>

    <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</div>

</body>
</html>