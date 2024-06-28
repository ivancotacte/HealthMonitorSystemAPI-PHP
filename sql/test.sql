CREATE DATABASE IF NOT EXISTS sql12716743;

USE sql12716743;

CREATE TABLE `tbl_weight` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `weight` varchar(255) NOT NULL,
    `created_at` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_logdata` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `heartRate` varchar(255) NOT NULL,
    `SpO2` varchar(255) NOT NULL,
    `created_at` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_healthmonitor` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `IDNumber` varchar(255) NOT NULL,
    `firstName` varchar(255) NOT NULL,
    `middleName` varchar(255) NOT NULL,
    `lastName` varchar(255) NOT NULL,
    `suffix` varchar(255) NOT NULL,
    `age` varchar(255) NOT NULL,
    `gender` varchar(255) NOT NULL,
    `height` varchar(255) NOT NULL,
    `weight` varchar(255) NOT NULL,
    `heartRate` varchar(255) NOT NULL,
    `SpO2` varchar(255) NOT NULL,
    `contactNum` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `created_at` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;