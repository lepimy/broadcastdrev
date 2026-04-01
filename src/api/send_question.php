<?php
global $dbh;
include "../config/config.php";
include "class/Visitor.php";
include "class/Questions.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$message = filter_var(
    $_GET["message"],
    FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    FILTER_NULL_ON_FAILURE,
);

$client_ip = $_SERVER["REMOTE_ADDR"];

$visitor = new Visitor($dbh);
$questions = new Questions($dbh);

if ($message !== null) {
    $result = $visitor->getByIp($client_ip);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (empty($row)) {
        $visitor->add($client_ip);
        $visitor_id = $dbh->lastInsertId();
    } else {
        $visitor_id = $row["id"];
    }

    $result = $questions->add($visitor_id, $message);

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
