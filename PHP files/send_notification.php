<?php

require 'firebase.php';

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;

$token = "d8XIzXEn4MVW0j2bcb22zj:APA91bFD-O4mWIHoM5oWWIAolv2VeEZ85x7K3dSnai1a9nMnNyitArYxpSDJzpfD0mMgNe8GjpvFi8-L2iCd8TGwvP90wjpvU_I0nD2xeWsX-IETm5YUwbM";

$message = CloudMessage::withTarget('token', $token)
    ->withNotification(
        Notification::create(
            'Medicine Reminder 💊',
            'Time to take your medicine!'
        )
    )
    ->withWebPushConfig(
        WebPushConfig::fromArray([
            'notification' => [
                'title' => 'Medicine Reminder 💊',
                'body' => 'Time to take your medicine!',
                'icon' => 'icon-192.png'
            ]
        ])
    );

try {

    $messaging->send($message);

    echo "Notification sent successfully!";

} catch (Exception $e) {

    echo "Error: " . $e->getMessage();

}
?>