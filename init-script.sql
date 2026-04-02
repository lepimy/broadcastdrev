USE broadcast;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
START TRANSACTION;

-- --------------------------------------------------------

CREATE TABLE `visitor` (
    `id` int NOT NULL AUTO_INCREMENT,
    `ip` varchar(255) NOT NULL,
    `is_active` boolean NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `question` (
    `id` int NOT NULL AUTO_INCREMENT,
    `visitor_id` int NOT NULL,
    `message` text NOT NULL,
    `is_read` boolean NOT NULL,
    `date` datetime NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (visitor_id) REFERENCES visitor(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `log` (
    `id` int NOT NULL AUTO_INCREMENT,
    `message` text NOT NULL,
    `date` datetime NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `info` (
    `id` int NOT NULL AUTO_INCREMENT,
    `broadcast_status` boolean NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

INSERT INTO info (broadcast_status) VALUES (0);
