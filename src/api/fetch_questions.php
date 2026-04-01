<?php
global $dbh;
include "../config/config.php";
include "class/Questions.php";
header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$questions = new Questions($dbh);

$result = $questions->getAll();

if ($result->rowCount() > 0) {
    $visitorArray = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $question = [
            "question_id" => $id,
            "message" => $message,
            "date" => $date,
            "is_read" => $is_read,
        ];

        $hasVisitorInArray = false;
        foreach ($visitorArray as $visitorItem) {
            if ($visitorItem["visitor_id"] == $visitor_id) {
                $hasVisitorInArray = true;
            }
        }

        if ($hasVisitorInArray) {
            $key = array_search(
                $visitor_id,
                array_column($visitorArray, "visitor_id"),
            );
            $visitorTemp = $visitorArray[$key];
            array_push($visitorTemp["questions"], $question);
            $visitorArray[$key] = $visitorTemp;
        } else {
            $visitor = [
                "visitor_id" => $visitor_id,
                "questions" => [$question],
            ];
            array_push($visitorArray, $visitor);
        }
    }

    http_response_code(200);
    echo json_encode($visitorArray);
}
