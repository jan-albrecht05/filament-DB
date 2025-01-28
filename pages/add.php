<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB - Hinzufügen</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    </div>
    <div id="main">
        <h1>Filament hinzufügen</h2>
        <form id="add-form" method="POST">
            <label for="id">Token:</label>
            <input type="text" id="id" name="id" disabled required><br>
            <label for="vendor">Hersteller:</label>
            <input type="text" id="vendor" name="vendor" required><br>
            <label for="color">Farbe:</label>
            <input type="color" id="color" name="color" value="#ff0000" required><br>
            <label for="material">Material:</label>
            <input type="text" id="material" name="material" placeholder="PLA" required><br>
            <div id="diameter-input">
                <label for="diameter">Durchmesser:</label>
                <div id="diameter-radio">
                    <input type="radio" id="diameter-1.75" name="diameter" value="1.75" required>
                    <label id="diameter1" for="diameter-1.75">1.75mm</label>
                    <input type="radio" id="diameter-2.85" name="diameter" value="2.85" required>
                    <label for="diameter-2.85">2.85mm</label>
                </div>
            </div>
            <br>
            <label for="price">Preis:</label>
            <input type="number" id="price" name="price" placeholder="Preis pro Spule" required><br>
            <label for="weight">Gewicht:</label>
            <input type="number" id="weight" name="weight" placeholder="Gewicht der Spule" required><br>
            <label for="owner">Besitzer:</label>
            <input type="text" id="owner" name="owner" placeholder="Besitzer der Spule" required><br>
            <label for="anzahl">Anzahl Spulen:</label>
            <input type="number" id="anzahl" name="anzahl" value="1" required><br>
            <label for="bedtemp">Bed-temp.:</label>
            <input type="number" id="bedtemp" name="bedtemp" value="60" required><br>
            <label for="nozzletemp">Nozzle-temp.:</label>
            <input type="number" id="nozzletemp" name="nozzletemp" value="220" required><br>
            <label for="img">Bild vom Benchy:</label>
            <input type="image" id="img-upload" name="img"><br>
            <label for="img2">Bild von der Spule:</label>
            <input type="image" id="img-upload" name="img2"><br>
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
            //$benchyImg = $_FILES['img']['name'];
            //$spoolImg = $_FILES['img2']['name'];
            $additionalinfo = $_POST['additionalinfo'];
            
            // Database connection
            $conn = new mysqli("localhost", "root", "", "filaments");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert data into the database
            $sql = "INSERT INTO `filaments`.`filament` (`hersteller`, `farbe`, `material`, `dicke`, `price`, `gewicht`, `besitzer`, `anzahl`, `bedtemp`, `nozzletemp`, `additionalinfo`) VALUES ('$hersteller', '$farbe', '$material', '$dicke', '$price', '$gewicht', '$besitzer', '$anzahl', '$bedtemp', '$nozzletemp', '$additionalinfo')";

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