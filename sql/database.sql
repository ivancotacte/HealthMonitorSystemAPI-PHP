CREATE DATABASE IF NOT EXISTS sql12718148;

USE sql12718148;

CREATE TABLE `tbl_users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `IDNumber` VARCHAR(50) NOT NULL,
    `firstName` VARCHAR(100) NOT NULL,
    `middleName` VARCHAR(100) DEFAULT NULL,
    `lastName` VARCHAR(100) NOT NULL,
    `suffix` VARCHAR(10) DEFAULT NULL,
    `age` TINYINT(3) UNSIGNED NOT NULL,
    `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
    `height` DECIMAL(5,2) NOT NULL COMMENT 'Height in cm',
    `weight` DECIMAL(5,2) NOT NULL COMMENT 'Weight in kg',
    `heartRate` TINYINT(3) UNSIGNED NOT NULL COMMENT 'Heart rate in bpm',
    `SpO2` TINYINT(3) UNSIGNED NOT NULL COMMENT 'Oxygen saturation in %',
    `contactNum` VARCHAR(15) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `ai_response` VARCHAR(100000) DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `IDNumber` (`IDNumber`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_weight` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `weight` DECIMAL(5,2) NOT NULL COMMENT 'Weight in kg',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_logdata` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `heartRate` TINYINT(3) UNSIGNED NOT NULL COMMENT 'Heart rate in bpm',
    `SpO2` TINYINT(3) UNSIGNED NOT NULL COMMENT 'Oxygen saturation in %',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;