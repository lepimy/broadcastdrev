<?php

// DB credentials.
define("DB_HOST", "db");
define("DB_USER", "root");
define("DB_PASS", "mariadb");
define("DB_NAME", "broadcast");

// Establish database connection.
try {
    $dbh = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"],
    );
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
