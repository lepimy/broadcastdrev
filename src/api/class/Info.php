<?php

class Info
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getBroadcastStatus()
    {
        $sql = "SELECT * FROM info LIMIT 1;";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query;
    }

    function updateBroadcastStatus($value)
    {
        $sql = "UPDATE info SET broadcast_status = :value";

        $query = $this->conn->prepare($sql);
        $query->bindParam(":value", $value, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
}
