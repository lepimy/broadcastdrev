<?php
global $dbh;
include "../config/config.php";
include "class/Info.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$status = filter_var(
    $_GET["status"],
    FILTER_VALIDATE_BOOLEAN,
    FILTER_NULL_ON_FAILURE,
);

if ($status !== null) {
    $info = new Info($dbh);
    $result = $info->updateBroadcastStatus($status);

    $resonse = [
        "success" => true,
        "error" => "",
    ];
    http_response_code(200);
    echo json_encode($resonse);
} else {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "Внутренняя ошибка сервера",
    ]);
}
