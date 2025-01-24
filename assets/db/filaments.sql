CREATE DATABASE filaments;

CREATE TABLE filament (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hersteller VARCHAR(15) NOT NULL,
    farbe VARCHAR(7) NOT NULL,
    material VARCHAR(7) NOT NULL,
    dicke INT NOT NULL,
    price INT NOT NULL,
    gewicht INT NOT NULL,
    besitzer VARCHAR(25) NOT NULL,
    anzahl INT NOT NULL,
    bedtemp INT NOT NULL,
    nozzletemp INT NOT NULL,
    benchyImg VARCHAR(120) NOT NULL,
    spoolImg VARCHAR(120) NOT NULL,
    additionalinfo VARCHAR(255) NOT NULL,
    active BOOLEAN DEFAULT true
);