-- Database Route_Shop 
CREATE DATABASE IF NOT EXISTS E_Shop DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE E_Shop;
SET default_storage_engine = InnoDB;

-- Users
CREATE TABLE IF NOT EXISTS users (
 id             INT PRIMARY KEY AUTO_INCREMENT,
 firstname      VARCHAR (60) NOT NULL,
 lastname       VARCHAR (60) NOT NULL,
 email          VARCHAR (100) NOT NULL,
 password       VARCHAR (255) NOT NULL,
 phone          VARCHAR (25),
 address        VARCHAR (100),
 img            VARCHAR (100),
 bio            TEXT,
 is_active      BOOLEAN DEFAULT true,
 type           TINYINT DEFAULT 0, 
 created_at     DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at     DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT users_lastname_unique UNIQUE (lastname),
 CONSTRAINT users_email_unique UNIQUE (email),
 CONSTRAINT users_invalid_email CHECK (email REGEXP '^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$')
);

-- Categories
CREATE TABLE IF NOT EXISTS categories (
 id              INT PRIMARY KEY AUTO_INCREMENT,
 name            VARCHAR (60) NOT NULL,
 created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Products
CREATE TABLE IF NOT EXISTS products (
 id              INT PRIMARY KEY AUTO_INCREMENT,
 cat_id          INT, 
 name            VARCHAR (60) NOT NULL,
 brand           VARCHAR (60) NOT NULL,
 description     TEXT DEFAULT "Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Error quibusdam officiis repellendus qui vitae ipsam, officia, adipisci voluptas, 
                 voluptatum temporibus iure nemo doloremque a tenetur nostrum neque cupiditate et. 
                 Tempora sequi quas sint, enim veritatis sed perferendis recusandae illo, esse tempore
                 consequatur odit accusamus voluptas dolor ex deserunt temporibus labore? Dignissimos 
                 corrupti enim in nostrum! Rem voluptas, pariatur dolores eaque illo reprehenderit perferendis
                 rerum odio praesentium nulla dolore distinctio? Veritatis",
 price           DECIMAL (5,2) DEFAULT 78,
 img             VARCHAR (100) NOT NULL,
 stars           INT DEFAULT 5,
 type            ENUM ('product', 'new_arrival') DEFAULT 'product',
 created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT products_fk FOREIGN KEY (cat_id) REFERENCES categories (id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Orders
CREATE TABLE IF NOT EXISTS orders (
 id              INT PRIMARY KEY AUTO_INCREMENT,
 user_id         INT,
 status          ENUM ('sent', 'delivered') DEFAULT 'sent',
 created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT orders_user_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Order_details
CREATE TABLE IF NOT EXISTS order_details (
 product_id      INT,
 order_id        INT, 
 status          ENUM ('sent', 'delivered') DEFAULT 'sent',
 created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT PRIMARY KEY (product_id, order_id),
 CONSTRAINT order_details_product_fk FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT order_details_order_fk FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE ON UPDATE CASCADE
);

---------------------------------------------------
-- Credentials to login
---------------------------------------------------
-- Admin
INSERT INTO users (firstname, lastname, email, password, type)
VALUES ('Admin', 'Admin', 'admin@email.com', '$2y$10$xqo3h9yzFWgk4OQqfGy0a.F/J1ogexdltnOqR/FKdfKVyFfSSer9S', 1); -- Password is admin

-- User
INSERT INTO users (firstname, lastname, email, password)
VALUES ('User', 'User', 'user@email.com', '$2y$10$4kXg1L7Qs1t5OM.LaQlUZuLb6Nzoo2wLKwk3pjgjt3LzHEelTCp/q'); -- Password is user
---------------------------------------------------

-- Insert Categories
INSERT INTO categories (name) VALUES ('Clothes'), ('Shoes');

-- Insert Products
INSERT INTO products(cat_id, name, brand, img, type)
VALUES (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f1.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f2.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f3.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f4.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f5.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f6.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f7.jpg', 'product'),
       (1, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/f8.jpg', 'product'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n1.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n2.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n3.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n4.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n5.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n6.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n7.jpg', 'new_arrival'),
       (2, 'Cartoon Astronaut T-Shirt', 'adidas', 'products/n8.jpg', 'new_arrival');


-- Messages
CREATE TABLE IF NOT EXISTS messages (
 id          INT PRIMARY KEY AUTO_INCREMENT,
 name        VARCHAR (100) NOT NULL,
 email       VARCHAR (100) NOT NULL,
 comment     TEXT NOT NULL,
 status      ENUM ('answered', 'pending') DEFAULT 'pending',
 created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT  messages_invalid_email CHECK (email REGEXP '^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$')
);

-- Users
CREATE TABLE IF NOT EXISTS todos (
 id             INT PRIMARY KEY AUTO_INCREMENT,
 user_id        INT,
 task           VARCHAR (50),
 status         BOOLEAN DEFAULT false,
 created_at     DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at     DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);