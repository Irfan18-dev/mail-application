-- Step 1: Create the database
CREATE DATABASE IF NOT EXISTS mail_application;
USE mail_application;

-- Step 2: Create the users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Step 3: Create the mails table
CREATE TABLE IF NOT EXISTS mails (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sender_id INT NOT NULL,
  to_email VARCHAR(100) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Optional: Remove old test user if needed
DELETE FROM users WHERE email = 'test@example.com';

-- Optional: Re-insert a test user (with hashed password)
INSERT INTO users (name, email, password)
VALUES ('Test User', 'test@example.com', '123456');
