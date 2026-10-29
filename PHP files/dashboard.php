<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM medicines WHERE user_id='$user_id'"
);

$data = mysqli_fetch_assoc($query);
$total_medicines = $data['total'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

<link rel="manifest" href="manifest.json">

<meta name="theme-color" content="#0077b6">

</head>

<body>

<div class="container">

    <h1> Medicine Reminder </h1>

    <h2>Welcome, <?php echo $_SESSION['name']; ?> 👋</h2>

    <div class="stats-card">
        <h3>Total Medicines</h3>
        <p><?php echo $total_medicines; ?></p>
    </div>

    <div class="buttons">
        <a href="add_medicine.php">➕ Add Medicine</a>
        <a href="view_medicines.php">📋 View Medicines</a>
        <a href="history.php">📜 History</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<script>

// Request notification permission
if ("Notification" in window)
{
    if (Notification.permission !== "granted" &&
        Notification.permission !== "denied")
    {
        Notification.requestPermission();
    }

    function checkReminder()
    {
        fetch("reminder.php")
        .then(response => response.json())
        .then(data => {

            if (Notification.permission === "granted")
            {
                data.forEach(function(medicine)
                {
                    new Notification("💊 Medicine Reminder", {
                        body: medicine.medicine_name +
                              " (" + medicine.dosage + ")" +
                              "\nTake your medicine now!"
                    });
                });
            }

        })
        .catch(error => console.log(error));
    }

    // Check every 5 seconds (for testing)
    setInterval(checkReminder, 60000);

    // Check immediately when page loads
    checkReminder();
}

</script>

<script>
if ('serviceWorker' in navigator)
{
    navigator.serviceWorker.register('service-worker.js')
    .then(function(registration)
    {
        console.log('Service Worker Registered');
    })
    .catch(function(error)
    {
        console.log('Service Worker Registration Failed');
    });
}
</script>

<script type="module" src="firebase-config.js"></script>

</body>
</html>