-- Database creation
CREATE DATABASE IF NOT EXISTS testwebdb;
USE testwebdb;

-- Table `langages`
CREATE TABLE IF NOT EXISTS langages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    langage VARCHAR(255) UNIQUE NOT NULL
);

-- Insert initial data
INSERT INTO langages (langage) VALUES ('Java'), ('C++'), ('C#')
ON DUPLICATE KEY UPDATE langage = langage;

-- Table `developpeur_web`
CREATE TABLE IF NOT EXISTS developpeur_web (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomPrenom VARCHAR(255) NOT NULL,
    langages VARCHAR(255) NOT NULL
);
