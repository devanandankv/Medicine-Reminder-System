<?php

$json = json_decode(
    file_get_contents("firebase-service-account.json"),
    true
);

echo "<h3>Firebase Service Account Loaded Successfully</h3>";
echo "Project ID: " . $json['project_id'] . "<br>";
echo "Client Email: " . $json['client_email'];

?>