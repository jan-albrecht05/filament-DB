<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB - Hinzufügen</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search">
</head>
<body>
    <div id="header">
        <div id="inner-header">
            <a id="logo" href="../index.php" class="center">
                <img id="logoimg" src="../assets/icons/filament-DB.png" alt="Filament-DB" title="Home">
            </a>
            <div id="suche" class="center">
                <input id="text-input" type="text" placeholder="Suche oder token eingeben..">
                <button id="search-btn"><span class="material-symbols-outlined center">search</span></button>
            </div>
            <div id="user" class="center">
                <div id="user-name">
                    Hallo <i>Gast</i>
                </div>
                <div id="user-profile-img">
                    <img src="../assets/icons/user.png" title="Gast" alt="Gast">
                </div>
            </div>
        </div>
    </div>
    <div id="main">
        <h1>Filament hinzufügen</h2>
        <form id="add-form">
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
            <label for="anzahl">Anzahl Spulen.:</label>
            <input type="number" id="anzahl" name="anzahl" value="1" required><br>
            <label for="bed-temmp">Bed-temp.:</label>
            <input type="number" id="bed-temmp" name="bed-temmp" value="60" required><br>
            <label for="nozzle-temmp">Nozzle-temp.:</label>
            <input type="number" id="nozzle-temmp" name="nozzle-temmp" value="220" required><br>
            <label for="img">Bild vom Benchy:</label>
            <input type="image" id="img-upload" name="img" required><br>
            <label for="img2">Bild von der Spule:</label>
            <input type="image" id="img-upload" name="img2" required><br>
            <label for="additional-info">Zusätzliche Infos:</label>
            <input type="text" id="additional-info" name="additional-info" placeholder="Tips"><br>
            <div id="buttons">
                <button id="savebtn" type="submit">speichern</button>
                <button id="resetbtn" type="reset">reset</button>
            </div>
        </form>
    </div>
        <?php
// Database connection
$dbpath = '../assets/db/filaments.db';

// Create connection
$conn = new SQLite3($dbpath);

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}

// Get the next free ID
$sql = "SELECT MAX(id) AS max_id FROM filaments";
$result = $conn->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
$next_id = $row['max_id'] + 1;

// Insert form data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $color = $_POST['color'];
    $diameter = $_POST['diameter'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    $manufacturer = $_POST['manufacturer'];
    $anzahl = $_POST['anzahl'];
    $nozzle_temp = $_POST['nozzle_temp'];
    $bed_temp = $_POST['bed_temp'];
    $owner = $_POST['owner'];
    $image1 = $_POST['image1'];
    $image2 = $_POST['image2'];
    $additional_info = $_POST['additional_info'];

    $sql = "INSERT INTO filaments (id, name, type, color, diameter, weight, price, manufacturer, anzahl, nozzle_temp, bed_temp, owner, image1, image2, additional_info) 
            VALUES ('$next_id', '$name', '$type', '$color', '$diameter', '$weight', '$price', '$manufacturer', '$anzahl', '$nozzle_temp', '$bed_temp', '$owner', '$image1', '$image2', '$additional_info')";

    if ($conn->exec($sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->lastErrorMsg();
    }
}

$conn->close();
?>
</body>
</html>