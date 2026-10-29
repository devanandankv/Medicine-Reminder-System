<?php

$json = json_decode(
    file_get_contents("firebase-service-account.json"),
    true
);

echo $json["project_id"];

?>