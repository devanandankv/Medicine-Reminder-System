<?php

date_default_timezone_set("Asia/Kolkata");

include "config.php";
require "firebase.php";

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;

$currentTime = date("H:i:00");
$currentDate = date("Y-m-d");

$query = mysqli_query($conn,"
SELECT medicines.*, users.fcm_token
FROM medicines
INNER JOIN users
ON medicines.user_id = users.id
WHERE reminder_time='$currentTime'
AND start_date <= '$currentDate'
AND end_date >= '$currentDate'
AND status='Active'
");

while($row=mysqli_fetch_assoc($query))
{

    if(empty($row['fcm_token']))
    {
        continue;
    }

    $message = CloudMessage::withTarget('token',$row['fcm_token'])

    ->withNotification(
        Notification::create(
            "💊 Medicine Reminder",
            "Time to take ".$row['medicine_name']
        )
    )

    ->withWebPushConfig(
        WebPushConfig::fromArray([
            'notification'=>[
                'title'=>"💊 Medicine Reminder",
                'body'=>"Take ".$row['medicine_name']." (".$row['dosage'].")",
                'icon'=>"icon-192.png"
            ]
        ])
    );

    try{

        $messaging->send($message);

        echo $row['medicine_name']." Notification Sent<br>";

    }
    catch(Exception $e){

        echo $e->getMessage();

    }

}

?>