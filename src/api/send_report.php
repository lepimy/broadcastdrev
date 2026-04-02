<?php
global $dbh;
include "../config/config.php";
include "class/Log.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$message = filter_var(
    $_GET["message"],
    FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    FILTER_NULL_ON_FAILURE,
);

$log = new Log($dbh);

if ($message !== null) {
    $result = $log->add($message);
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
