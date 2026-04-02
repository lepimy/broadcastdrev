<?php
global $dbh;
include "../config/config.php";
include "class/Log.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$log = new Log($dbh);

$result = log->getAll();

if ($result->rowCount() > 0) {
    $logArray = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $log = [
            "question_id" => $id,
            "message" => $message,
            "date" => $date,
            "is_read" => $is_read,
        ];
        array_push($logArray, $log);
    }

    http_response_code(200);
    echo json_encode($logArray);
}
