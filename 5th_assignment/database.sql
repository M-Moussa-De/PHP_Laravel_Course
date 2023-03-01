-- Create Database c39 
CREATE DATABASE IF NOT EXISTS C39 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE C39;
SET default_storage_engine = InnoDB;

-- Create table course_details(id, course_name,price, created_at)
CREATE TABLE IF NOT EXISTS course_details (
 id              INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 course_name     VARCHAR (60) NOT NULL,
 price           DECIMAL (5,2),
 created_at      DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create table instructors (id, name, course_id,salary)
CREATE TABLE IF NOT EXISTS instructors (
 id             INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 name           VARCHAR (60) NOT NULL,
 course_id      INT UNSIGNED,
 salary         DECIMAL (7,2),
 CONSTRAINT instructors_course_id_fk FOREIGN KEY (course_id) REFERENCES course_details (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create table students(id, name, age,course_id ,instructor_id,entry_date)
CREATE TABLE IF NOT EXISTS students (
 id             INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 name           VARCHAR (60) NOT NULL,
 birthdate      DATE NOT NULL,  -- age is a derived attribute, therefore, is better to store the DOB instead
 course_id      INT UNSIGNED,
 instructor_id  INT UNSIGNED,
 entry_date     DATE DEFAULT CURRENT_DATE,
 CONSTRAINT students_course_id_fk FOREIGN KEY (course_id) REFERENCES course_details (id) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT students_instructor_id_fk FOREIGN KEY (instructor_id) REFERENCES instructors (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Course details(php-laravel, Nodejs,.Dot-Net, java spring)
INSERT INTO course_details (course_name)
VALUES ('php-laravel'), ('Nodejs'), ('.Dot-Net'), ('java spring');

-- Instructors (anything)
INSERT INTO instructors (name, salary)
VALUES ('John', 5000), ('Gamila', 3587), ('Mark', 4570.99), ('Rebecca', 4651.89);

-- Students (anything)
INSERT INTO students (name, birthdate)
VALUES ('Tim', '10-10-1995'), ('Alessandra', '18-05-2001'), ('Alex', '02-08-2003'), ('Andi', '12-11-2004');

-- Create user called (your_name like youssif)
CREATE USER IF NOT EXISTS 'mahmoud'@'localhost' IDENTIFIED BY 'secret';
-- Create user bad_boy 
CREATE USER IF NOT EXISTS 'bad_boy'@'localhost' IDENTIFIED BY 'top_secret';
-- Create user loki 
CREATE USER IF NOT EXISTS 'loki'@'localhost' IDENTIFIED BY 'classified';

-- Grant youssif (insert, select, update, delete, create, with grant option) on all tables
GRANT INSERT, SELECT, UPDATE, DELETE, CREATE ON C39.* TO 'mahmoud'@'localhost';
-- Grant bad_boy insert, select, delete on students table
GRANT INSERT, SELECT, DELETE ON C39.students TO 'bad_boy'@'localhost';
-- Grant loki select only
GRANT SELECT ON C39.* TO 'loki'@'localhost';

-- Connect by user called (your name)
mysql -umahmoud -p
-- Insert data into course_details, instructors 
INSERT INTO course_details (course_name)
VALUES ('Go'), ('Python');
INSERT INTO instructors (name, salary)
VALUES ('Gamal', 7500), ('Gamila', 3587);

-- Connect by bad_boy 
mysql -ubad_boy -p
-- Insert into students tables
INSERT INTO students (name, birthdate) ------------------------------------------------------------
VALUES ('Issac', '18-03-1997'), ('Tomas', '28-06-2004');

-- Connect to user called your name
mysql -umahmoud -p
-- Grant insert, select on course_details for user bad_boy
GRANT INSERT, SELECT ON C39.course_details TO 'bad_boy'@'localhost';

-- Connect to user bad_boy
mysql -ubad_boy -p
-- Insert 3 rows by mistake ??
INSERT INTO IF EXISTS course_details (course_name)
VALUES ('Laravel 9'), ('Software engineering', 'APS.Net Core');
-- So take insert privilege from bad_boy
REVOKE INSERT ON C39.course_details FROM bad_boy;
-- and rollback all rows was inserted
SAVEPOINT before_bad_boy_inserted_rows; -- This step should stand before the bad boy inserts any data
ROLLBACK before_bad_boy_inserted_rows;

-- Connect to user called your name
mysql -umahmoud -p
-- Create table course_archive(id, course_name, price, created_at)
CREATE TABLE IF NOT EXISTS course_archive (
 id             INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
 course_name    VARCHAR (60) NOT NULL,
 price          DECIMAL (5,2),
 created_at     DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- I want when delete row from table course_details take this row and insert him into course_archive??
CREATE TRIGGER course_details_before_delete
BEFORE DELETE ON course_details
FOR EACH ROW
BEGIN
    INSERT INTO course_archive
    VALUES(OLD.id, OLD.course_name, OLD.price, NOW());
END;
-- So delete courses(php-laravel and Nodejs)
DELETE FROM course_details WHERE course_name IN ('php-laravel', 'Nodejs')
-- Restore all rows from course_archive to course_details
INSERT INTO course_details
SELECT *
FROM course_archive;

-- Connect to bad_boy
mysql -ubad_boy -p
-- Load excel file into table student (excel file have 20 rows about students)
LOAD DATA INFILE '/path/to/students.csv' INTO TABLE student
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n' -- or '\n'
--IGNORE 1 ROWS; -- to ignore the first row if it contains the column headers

-- Connect to user called your name
mysql -umahmoud -p
-- Insert row into course_details
INSERT INTO IF EXISTS course_details (course_name)
VALUES ('Machine learning');
-- I want you to open a new session to see this row??
SELECT * FROM course_details ORDER BY id DESC LIMIT 1;
-- Option 2 
SELECT * FROM my_table WHERE id = LAST_INSERT_ID();

-- lock account bad_boy 
UPDATE mysql.user SET account_locked = 'Y' WHERE user = 'bad_boy';

-- Connect to loki
mysql -uloki -p
-- 1- I want a excell reports about all students, instructors
SELECT * INTO OUTFILE '/path/to/students.csv' 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
ESCAPED BY '\\' 
LINES TERMINATED BY '\n'
FROM students;

SELECT * INTO OUTFILE '/path/to/instructors.csv' 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
ESCAPED BY '\\' 
LINES TERMINATED BY '\n'
FROM instructors;
-- 2- count all students in course php-laravel
SELECT COUNT(*) AS PHP_Laravel_Total_Students FROM course_details cd
JOIN studenst s ON cd.id = s.course_id
WHERE course_name = 'php-laravel'
-- 3- display course name, student name, course_price, instructor_name and store this report in temporary table 
CREATE TEMPORARY TABLE IF NOT EXISTS report_students_courses AS
SELECT
    cd.name AS course_name,
    s.name AS student_name,
    cd.course_price,
    i.name AS instructor_name
FROM
    course_details cd
    INNER JOIN students s ON cd.id = s.course_id
    INNER JOIN instructors i ON cd.instructor_id = i.id;

-- 4- instructors have salary greater than 3000
SELECT * FROM instructor WHERE salary > 3000;
-- 5- instructors have salary greater than instructors called joe and store this in view called instructor_joe
CREATE VIEW instructor_joe AS
SELECT * 
FROM instructors 
WHERE salary > (
SELECT salary
FROM instructors
WHERE name = 'joe'
);

-- Connect to root
mysql -uroot -p
-- Show all tables
SHOW TABLES;
-- Show constraints
SELECT 
    CONSTRAINT_NAME, 
    TABLE_NAME, 
    COLUMN_NAME, 
    REFERENCED_TABLE_NAME, 
    REFERENCED_COLUMN_NAME
FROM 
    INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE 
    REFERENCED_TABLE_SCHEMA = 'C39';
-- Show users
SELECT 
    User, 
    Host 
FROM 
    mysql.user;
-- Show lock account
SELECT * FROM mysql.user WHERE account_locked='Y';
-- Show lock tables
SHOW OPEN TABLES WHERE In_use > 0;

-- Connect to user called your name
mysql -umahmoud -p
-- Create index in student_name
CREATE INDEX idx_student_name ON students ('name');

-- 1-Delete user bad_boy 
DROP USER 'bad_boy'@'%';
-- 2-Make a backup for your database (export your schema)
mysqldump -u [mahmoud] -p --no-data [C39] > [C39_schema].sql
-- 3-Import your schema in a new database called c39_copy
CREATE DATABASE IF NOT EXISTS C39_copy;
USE C39_copy;
mysql -umahmoud -p c39_copy < /path/to/C39_schema.sql
SHOW TABLES;


























