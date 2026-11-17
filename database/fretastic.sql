CREATE DATABASE IF NOT EXISTS Fretastic
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'fretastic_app'@'localhost'
IDENTIFIED BY 'clnjessamae';

GRANT SELECT, INSERT, UPDATE, DELETE
ON Fretastic.*
TO 'fretastic_app'@'localhost';

USE Fretastic;

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    email VARCHAR(254) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    account_type ENUM('buyer', 'seller') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SHOW TABLES FROM Fretastic;

DESCRIBE Fretastic.users;

SELECT COUNT(*) AS total_users
FROM Fretastic.users;

USE Fretastic;
DESCRIBE users;
