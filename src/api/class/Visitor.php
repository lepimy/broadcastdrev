<?php

class Visitor
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
                ORDER BY date";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query;
    }

    function getByIp($ip)
    {
        $sql = "SELECT * FROM visitor WHERE visitor.ip = :ip LIMIT 1;";
        $query = $this->conn->prepare($sql);
        $query->bindParam(":ip", $ip, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }

    function add($ip)
    {
        $sql = "INSERT INTO visitor (ip, is_active) values (:ip, 1);";

        $query = $this->conn->prepare($sql);
        $query->bindParam(":ip", $ip, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }
}
