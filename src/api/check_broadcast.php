<?php
global $dbh;
include "../config/config.php";
include "class/Info.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$info = new Info($dbh);

$result = $info->getBroadcastStatus();

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $resonse["broadcast"] = $row["broadcast_status"];

    http_response_code(200);
    echo json_encode($resonse);
}
