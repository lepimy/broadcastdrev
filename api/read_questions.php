<?php
global $dbh;
include "../config/config.php";
include "class/Questions.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$visitorId = filter_var(
    $_GET["visitor_id"],
    FILTER_VALIDATE_INT,
    FILTER_NULL_ON_FAILURE,
);

if ($visitorId !== null) {
    $questions = new Questions($dbh);
    $result = $questions->updateIsReadByVisitorId($visitorId);

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
