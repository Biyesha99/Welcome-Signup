CREATE DATABASE Users;

USE Users;

INSERT INTO userdata (username, email, password) VALUES 
('User1', 'user1@gmail.com', 'password123'), -- hashed password: 'password123'
('jane_smith', 'jane@gmail.com', 'securepass'), -- hashed password: 'securepass'
('alice_jones', 'alice@gmail.com', 'mypassword'); -- hashed password: 'mypassword'

INSERT INTO welcome_mail (user_id, email, sent) VALUES
(1, 'user1@gmail.com', TRUE),
(2, 'jane@gmail.com', TRUE),
(3, 'alice@gmail.com', TRUE);


CREATE TABLE userdata (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(300) NOT NULL,
      email VARCHAR(300) NOT NULL,
      password VARCHAR(300) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE welcome_mail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    email VARCHAR(300),
    sent BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES userdata(id)
);

DELIMITER ||

CREATE TRIGGER after_user_insert
AFTER INSERT ON userdata
FOR EACH ROW
BEGIN
  INSERT INTO welcome_mail (user_id, email) VALUES (NEW.id, NEW.email);
END ||

DELIMITER ;