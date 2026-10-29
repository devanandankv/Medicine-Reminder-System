<?php

$data = json_decode(
    file_get_contents("firebase-service-account.json"),
    true
);

echo "<h3>Firebase Service Account Test</h3>";

echo "Project ID: " . $data['project_id'] . "<br><br>";

echo "Client Email: " . $data['client_email'] . "<br><br>";

echo "Private Key Exists: ";

if (!empty($data['private_key'])) {
    echo "YES";
} else {
    echo "NO";
}

?>