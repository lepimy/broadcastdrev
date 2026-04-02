<?php

class Questions
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll()
    {
        $sql = "SELECT question.id, question.message, question.date, question.is_read, question.visitor_id, visitor.ip
                FROM question
                JOIN visitor ON visitor.id = question.visitor_id
                WHERE visitor.is_active  = 1
                ORDER BY date DESC";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query;
    }

    function updateIsReadByVisitorId($value)
    {
        $sql =
            "UPDATE question SET question.is_read = 1 WHERE question.visitor_id = :value";

        $query = $this->conn->prepare($sql);
        $query->bindParam(":value", $value, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    function add($visitor_id, $message)
    {
        $sql =
            "INSERT INTO question (visitor_id, message, is_read, date) values (:visitor_id, :message, 0, NOW() + INTERVAL 3 hour);";

        $query = $this->conn->prepare($sql);
        $query->bindParam(":visitor_id", $visitor_id, PDO::PARAM_INT);
        $query->bindParam(":message", $message, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }
}
