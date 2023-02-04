CREATE DATABASE IF NOT EXISTS M_M DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
SET default_storage_engine = InnoDB;

USE M_M;


-- Users
CREATE TABLE IF NOT EXISTS Users (
 id              INT PRIMARY KEY AUTO_INCREMENT,
 firstname       VARCHAR (50) NOT NULL,
 lastname        VARCHAR (50) NOT NULL,
 email           VARCHAR (150) NOT NULL,
 password        VARCHAR(255) NOT NULL,
 type            TINYINT DEFAULT 1,
 phone           VARCHAR (25),
 street          VARCHAR (50),
 zip             VARCHAR (50),
 city            VARCHAR (50),
 country         VARCHAR (50),
 cardnr          VARCHAR (50),
 CONSTRAINT User_Invalid_Email CHECK (email REGEXP '^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$')
);
