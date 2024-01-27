--database name : php_test

-- creating main user id and password  
-- O23MCA110202

CREATE TABLE Admin_users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cont_form (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone varchar(100) NOT NULL UNIQUE,
    subject varchar (100) NOT NULL,
    message LONGTEXT 
)