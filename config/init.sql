CREATE DATABASE IF NOT EXISTS baim_db;
USE baim_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  surname VARCHAR(30) NOT NULL,
  login VARCHAR(30) NOT NULL,
  password CHAR(40) NOT NULL
);

CREATE TABLE IF NOT EXISTS permissions (
  module_id INT NOT NULL,
  user_id INT NOT NULL
);

CREATE TABLE IF NOT EXISTS modules (
  id INT AUTO_INCREMENT PRIMARY KEY,
  path VARCHAR(30) NOT NULL,
  name VARCHAR(60) NOT NULL
);


INSERT INTO users(name, surname, login, password)
SELECT 'baim', 'baim', 'baim', "7a544776eddc3a3928651242bf7b7d6630706733"
WHERE NOT EXISTS (SELECT 1 FROM users);

INSERT INTO modules(path, name)
SELECT 'upload', 'Prześlij plik'
WHERE NOT EXISTS (SELECT 1 FROM modules);

INSERT INTO permissions
SELECT 1, 1
WHERE NOT EXISTS (SELECT 1 FROM permissions);