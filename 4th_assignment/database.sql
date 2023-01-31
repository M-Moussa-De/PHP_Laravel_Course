-----------------------------
-- 1
-----------------------------
CREATE DATABASE IF NOT EXISTS Route DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
SET default_storage_engine = InnoDB;

USE Route;

-----------------------------
-- 2
-----------------------------
CREATE TABLE IF NOT EXISTS Employees (
 id         INT PRIMARY KEY AUTO_INCREMENT,
 name       VARCHAR (50) NOT NULL,
 email      VARCHAR (150) NOT NULL,
 phone      VARCHAR (25),
 job        VARCHAR (50),
 country    VARCHAR (50) NOT NULL,
 CONSTRAINT Emp_Invalid_Email CHECK (email REGEXP '^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$')
);

-----------------------------
-- 3
-----------------------------
INSERT INTO Employees (name, email, phone, job, country)
VALUES ('Mahmoud','mahmoud@gmail.com','01149060652','CS','Egypt'),
       ('Hambozo','hambozo@gmail.com','01149060653','CS','USA'),
	   ('Manga','manga@yahoo.com','01249060654','IT','Egypt'),
       ('Noura','noura@yahoo.com','01249060655','IT','USA'),
       ('Ola','ola@yahoo.com','01049060654','IT','India'),
       ('Wagih','wagih@gmail.com','01049060657','CS','India'),
       ('Mohamed','Mohamed@gmail.com','01149060650','IS','Iraq'),
       ('Ahmed','Ahmed@gmail.com','01549060650','IS','BRAZIL'),
       ('Salma','Salma@gmail.com',NULL,NULL,'BRAZIL'),
	   ('Sarah','Sarah@gmail.com',NULL,NULL,'India');
       
-----------------------------
-- 4
-----------------------------
SHOW DATABASES;
       
-----------------------------
-- 5
-----------------------------
SELECT Host, User FROM mysql.user;       
       
-----------------------------
-- 6
-----------------------------       
SELECT table_name AS 'Table name',
       constraint_name AS 'Constraint name',
	   constraint_type AS 'Constarint type'
FROM information_schema.table_constraints
WHERE constraint_schema = 'Route';
       
-----------------------------
-- 7
----------------------------
SELECT table_name AS 'Tables'
FROM information_schema.tables
WHERE table_schema = 'Route';
       
-----------------------------
-- 8
----------------------------
SELECT User() AS 'Current user';
       
-----------------------------
-- 9
----------------------------
SELECT * FROM Employees;
       
-----------------------------
-- 10
----------------------------
SELECT name, country, job
FROM Employees;
       
-----------------------------
-- 11
----------------------------
SELECT *
FROM Employees
WHERE country = 'Egypt';
       
-----------------------------
-- 12
----------------------------
SELECT *
FROM Employees
WHERE job = 'IT';
       
-----------------------------
-- 13
----------------------------
SELECT *
FROM Employees
WHERE phone LIKE '012%';
       
-----------------------------
-- 14
----------------------------
SELECT DISTINCT(country)
FROM Employees;
       
-----------------------------
-- 15
----------------------------
SELECT *
FROM Employees
LIMIT 3;
       
-----------------------------
-- 16
----------------------------
SELECT *
FROM Employees
LIMIT 3, 3;
       
-----------------------------
-- 17
----------------------------
SELECT *
FROM Employees
WHERE email LIKE '%@yahoo.com';
       
-----------------------------
-- 18
----------------------------
SELECT *
FROM Employees
WHERE job IS NULL OR phone IS NULL;
       
-----------------------------
-- 19
----------------------------
SELECT *
FROM Employees
WHERE job = 'CS' AND country = 'USA';
       
-----------------------------
-- 20
----------------------------
SELECT *
FROM Employees
WHERE email LIKE '%yahoo.com' AND country = 'Egypt';
       
-----------------------------
-- 21
----------------------------
SELECT *
FROM Employees
WHERE country = 'Brazil' AND job IS NULL;
       
-----------------------------
-- 22
----------------------------
SELECT *
FROM Employees
WHERE country = 'USA' OR job = 'IT';
       
-----------------------------
-- 23
----------------------------
SELECT *
FROM Employees
WHERE phone LIKE '%0' AND country = 'Iraq';
       
-----------------------------
-- 25
----------------------------
DELETE FROM Employees
WHERE job IS NULL;
       
-----------------------------
-- 26
----------------------------
DELETE FROM Employees
WHERE (SELECT COUNT(*) FROM Employees) > 3
ORDER BY id
LIMIT 3;
       
-----------------------------
-- 27
----------------------------
DELETE FROM Employees
WHERE phone LIKE '015%';
       
-----------------------------
-- 28
----------------------------
TRUNCATE Employees;
       
-----------------------------
-- 29
----------------------------
DROP TABLE Employees;
       
-----------------------------
-- 30
----------------------------
DROP DATABASE Route;

-----------------------------
-- Second question
----------------------------
CREATE TABLE IF NOT EXISTS Test (
 id         INT PRIMARY KEY AUTO_INCREMENT,
 createdAt  DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Test (CreatedAt)
VALUES ('2002-02-01'),
       ('2002-08-01'),
       ('2022-08-02');
       
-----------------------------
-- 1
----------------------------
SELECT *
FROM Test
WHERE MONTH(createdAT) = 8;
       
-----------------------------
-- 2
----------------------------
SELECT *
FROM Test
WHERE DAY(createdAT) = 1;
