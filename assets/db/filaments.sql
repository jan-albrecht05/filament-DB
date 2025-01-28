CREATE DATABASE filaments;

USE filaments;

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Filament</title>
</head>
<body>
    <div>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="vendor">Hersteller:</label>
            <input type="text" id="vendor" name="vendor" required><br>
            <label for="color">Farbe:</label>
            <input type="text" id="color" name="color" required><br>
            <label for="material">Material:</label>
            <input type="text" id="material" name="material" required><br>
            <label for="diameter">Durchmesser:</label>
            <input type="text" id="diameter" name="diameter" required><br>
            <label for="price">Preis:</label>
            <input type="text" id="price" name="price" required><br>
            <label for="weight">Gewicht:</label>
            <input type="text" id="weight" name="weight" required><br>
            <label for="owner">Besitzer:</label>
            <input type="text" id="owner" name="owner" required><br>
            <label for="anzahl">Anzahl:</label>
            <input type="text" id="anzahl" name="anzahl" required><br>
            <label for="bedtemp">Bed Temp:</label>
            <input type="text" id="bedtemp" name="bedtemp" required><br>
            <label for="nozzletemp">Nozzle Temp:</label>
            <input type="text" id="nozzletemp" name="nozzletemp" required><br>
            <label for="img">Bild vom Benchy:</label>
            <input type="file" id="img" name="img"><br>
            <label for="img2">Bild von der Spule:</label>
            <input type="file" id="img2" name="img2"><br>
            <label for="additionalinfo">Zusätzliche Infos:</label>
            <input type="text" id="additionalinfo" name="additionalinfo" placeholder="Tips"><br>
            <div id="buttons">
                <button id="savebtn" type="submit">speichern</button>
                <button id="resetbtn" type="reset">reset</button>
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hersteller = $_POST['vendor'];
            $farbe = $_POST['color'];
            $material = $_POST['material'];
            $dicke = $_POST['diameter'];
            $price = $_POST['price'];
            $gewicht = $_POST['weight'];
            $besitzer = $_POST['owner'];
            $anzahl = $_POST['anzahl'];
            $bedtemp = $_POST['bedtemp'];
            $nozzletemp = $_POST['nozzletemp'];
            $additionalinfo = $_POST['additionalinfo'];

            // Handle file uploads
            $benchyImg = $_FILES['img']['name'];
            $spoolImg = $_FILES['img2']['name'];

            // Database connection
            $conn = new mysqli("localhost", "root", "", "filaments");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert data into the database
            $sql = "INSERT INTO filaments (hersteller, farbe, material, dicke, price, gewicht, besitzer, anzahl, bedtemp, nozzletemp, benchyImg, spoolImg, additionalinfo) 
                    VALUES ('$hersteller', '$farbe', '$material', '$dicke', '$price', '$gewicht', '$besitzer', '$anzahl', '$bedtemp', '$nozzletemp', '$benchyImg', '$spoolImg', '$additionalinfo')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>