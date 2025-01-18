-- Create a database
CREATE DATABASE filaments;

-- Use the database
USE filaments;

-- Create a table
CREATE TABLE filament (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hersteller VARCHAR(15) NOT NULL,
    farbe VARCHAR(7) NOT NULL,
    material VARCHAR(7) NOT NULL,
    dicke INT(7) NOT NULL,
    benchyImg VARCHAR(120) NOT NULL,
    spoolImg VARCHAR(120) NOT NULL,
    besitzer VARCHAR(25) NOT NULL,
    bed-temp INT(3) NOT NULL,
    nozzle-temp INT(3) NOT NULL,
    price INT(7) NOT NULL,
    gewicht INT(4) NOT NULL,
    tipps VARCHAR(255) NOT NULL
);