<?php

class Log
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll()
    {
        $sql = "SELECT * FROM log;";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query;
    }

    function add($value)
    {
        $sql =
            "INSERT INTO log (message, date) values (:value, NOW() + INTERVAL 3 hour);";

        $query = $this->conn->prepare($sql);
        $query->bindParam(":value", $value, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }
}
