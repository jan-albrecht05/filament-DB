<?php
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['rolle']) || $_SESSION['rolle'] !== 'admin') {
    header("Location: login.php?redirect=add.php");
    exit;
}

$db = new SQLite3("../assets/db/ff.db");

// Get the id from the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ungültige ID.");
}
$id = (int)$_GET['id'];

// Load existing data
$stmt = $db->prepare("SELECT * FROM filament WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$result = $stmt->execute();
$row = $result->fetchArray(SQLITE3_ASSOC);

if (!$row) {
    die("Kein Eintrag gefunden.");
}

// --- MOVE FORM PROCESSING HERE ---
$allowedimgtypes = array("png", "jpeg", "jpg", "JPG", "JPEG", "PNG", "ICO", "ico");
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

    // Handle file uploads (optional)
    $benchyImgName = $row['benchyImg'];
    if (!empty($_FILES['img']['name'])) {
        $benchyImg = $_FILES['img']['name'];
        $img_extention = pathinfo($benchyImg, PATHINFO_EXTENSION);
        if(in_array($img_extention, $allowedimgtypes)){
            $tmpNameBenchy = $_FILES['img']['tmp_name'];
            $benchyImgName = $id . '.benchy.' . $img_extention;
            $targetpathBenchy = "../assets/img/uploads/" . $benchyImgName;
            move_uploaded_file($tmpNameBenchy, $targetpathBenchy);
        }
    }
    $spoolImgName = $row['spoolImg'];
    if (!empty($_FILES['img2']['name'])) {
        $spoolImg = $_FILES['img2']['name'];
        $img2_extention = pathinfo($spoolImg, PATHINFO_EXTENSION);
        if(in_array($img2_extention, $allowedimgtypes)){
            $tmpNameSpool = $_FILES['img2']['tmp_name'];
            $spoolImgName = $id . '.spool.' . $img2_extention;
            $targetpathSpool = "../assets/img/uploads/" . $spoolImgName;
            move_uploaded_file($tmpNameSpool, $targetpathSpool);
        }
    }

    // Update the database
    $stmt = $db->prepare("UPDATE filament SET hersteller = :hersteller, farbe = :farbe, material = :material, dicke = :dicke, price = :price, gewicht = :gewicht, besitzer = :besitzer, anzahl = :anzahl, bedtemp = :bedtemp, nozzletemp = :nozzletemp, benchyImg = :benchyImg, spoolImg = :spoolImg, additionalinfo = :additionalinfo WHERE id = :id");
    $stmt->bindValue(':hersteller', $hersteller, SQLITE3_TEXT);
    $stmt->bindValue(':farbe', $farbe, SQLITE3_TEXT);
    $stmt->bindValue(':material', $material, SQLITE3_TEXT);
    $stmt->bindValue(':dicke', $dicke, SQLITE3_TEXT);
    $stmt->bindValue(':price', $price, SQLITE3_TEXT);
    $stmt->bindValue(':gewicht', $gewicht, SQLITE3_TEXT);
    $stmt->bindValue(':besitzer', $besitzer, SQLITE3_TEXT);
    $stmt->bindValue(':anzahl', $anzahl, SQLITE3_TEXT);
    $stmt->bindValue(':bedtemp', $bedtemp, SQLITE3_TEXT);
    $stmt->bindValue(':nozzletemp', $nozzletemp, SQLITE3_TEXT);
    $stmt->bindValue(':benchyImg', $benchyImgName, SQLITE3_TEXT);
    $stmt->bindValue(':spoolImg', $spoolImgName, SQLITE3_TEXT);
    $stmt->bindValue(':additionalinfo', $additionalinfo, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    header("Location: filament.php?id=" . $id);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Filament</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
    <script src="../assets/js/footer.js" defer></script>
    <script>
        let loggedInUser = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
        let loggedInUserImg = <?php echo isset($_SESSION['profile_picture']) ? json_encode($_SESSION['profile_picture']) : 'null'; ?>;
    </script>
    <style>
        @media (min-height:918px) {
            #footer{
                position: absolute;
            }
        }
    </style>
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    </div>
    <div id="main">
        <h1>Filament hinzufügen</h2>
        <form id="add-form" method="POST" enctype="multipart/form-data">
            <label for="id">Token:</label>
            <input type="text" id="id" name="id_display" value="<?php echo $row['id']; ?>" disabled title="nicht änderbar"><br>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="vendor">Hersteller:</label>
            <input type="text" id="vendor" name="vendor" value="<?php echo htmlspecialchars($row['hersteller']); ?>" required><br>
            <label for="color">Farbe:</label>
            <input type="color" id="color" name="color" value="<?php echo htmlspecialchars($row['farbe']); ?>" required><br>
            <label for="material">Material:</label>
            <select id="material" name="material" required>
                <?php
                $materials = ["ABS","ASA","CPE","PLA","PLA+","PETG","PETG-CF","TPU","Andere"];
                foreach ($materials as $mat) {
                    $selected = ($row['material'] == $mat) ? 'selected' : '';
                    echo "<option value=\"$mat\" $selected>$mat</option>";
                }
                ?>
            </select><br>
            <div id="diameter-input">
                <label for="diameter">Durchmesser:</label>
                <div id="diameter-radio">
                    <input type="radio" id="diameter-1.75" name="diameter" value="1.75" <?php if($row['dicke'] == "1.75") echo "checked"; ?> required>
                    <label id="diameter1" for="diameter-1.75">1.75mm</label>
                    <input type="radio" id="diameter-2.85" name="diameter" value="2.85" <?php if($row['dicke'] == "2.85") echo "checked"; ?> required>
                    <label id="diameter2" for="diameter-2.85">2.85mm</label>
                </div>
            </div>
            <br>
            <label for="price">Preis:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required><br>
            <label for="weight">Gewicht:</label>
            <input type="number" id="weight" name="weight" value="<?php echo htmlspecialchars($row['gewicht']); ?>" required><br>
            <label for="owner">Besitzer:</label>
            <input type="text" id="owner" name="owner" value="<?php echo htmlspecialchars($row['besitzer']); ?>" required><br>
            <label for="anzahl">Anzahl Spulen:</label>
            <input type="number" id="anzahl" name="anzahl" value="<?php echo htmlspecialchars($row['anzahl']); ?>" required><br>
            <label for="bedtemp">Bed-temp.:</label>
            <input type="number" id="bedtemp" name="bedtemp" value="<?php echo htmlspecialchars($row['bedtemp']); ?>" required><br>
            <label for="nozzletemp">Nozzle-temp.:</label>
            <input type="number" id="nozzletemp" name="nozzletemp" value="<?php echo htmlspecialchars($row['nozzletemp']); ?>" required><br>
            <label for="img">Bild vom Benchy (leer lassen für kein Update):</label>
            <input type="file" id="img" name="img"><br>
            <label for="img2">Bild von der Spule (leer lassen für kein Update):</label>
            <input type="file" id="img2" name="img2"><br>
            <label for="additionalinfo">Zusätzliche Infos:</label>
            <textarea id="additionalinfo" name="additionalinfo" rows="4"><?php echo htmlspecialchars($row['additionalinfo']); ?></textarea><br>
            <div id="buttons">
                <button id="savebtn" type="submit">speichern</button>
                <button id="resetbtn" type="reset">reset</button>
            </div>
        </form>
    </div>
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</html>