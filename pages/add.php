<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Filament</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
    <script src="../assets/js/footer.js" defer></script>
    <style>
        @media (min-height:918px) {
            #footer{
                position: absolute;
            }
        }
    </style>
</head>
<body>
     <?php
    // Check if the user is logged in and has admin privileges
    if (!isset($_SESSION['rolle']) || $_SESSION['rolle'] !== 'admin') {
        header("Location: login.php?redirect=add.php");
        exit;
    }
    ?>
    <?php
            $db = new SQLite3("../assets/db/ff.db");
            $result = $db->querySingle("SELECT MAX(id) FROM filament");
            $id = $result ? $result + 1 : 1;
        ?>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    </div>
    <div id="main">
        <h1>Filament hinzufügen</h2>
        <form id="add-form" method="POST" enctype="multipart/form-data">
            <label for="id">Token:</label>
            <input type="text" id="id" name="id_display" value="<?php echo $id; ?>" disabled title="nicht änderbar"><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="vendor">Hersteller:</label>
            <input type="text" id="vendor" name="vendor" required><br>
            <label for="color">Farbe:</label>
            <input type="color" id="color" name="color" value="#ff0000" required><br>
            <label for="material">Material:</label>
            <select id="material" name="material" required>
                <option value="" disabled selected>Bitte wählen ▼</option>
                <option value="ABS">ABS</option>
                <option value="ASA">ASA</option>
                <option value="CPE">CPE</option>
                <option value="PLA">PLA</option>
                <option value="PLA+">PLA+</option>
                <option value="PETG">PETG</option>
                <option value="PETG-CF">PETG-CF</option>
                <option value="TPU">TPU</option>
                <option value="Andere">Andere</option>
            </select><br>
            <div id="diameter-input">
                <label for="diameter">Durchmesser:</label>
                <div id="diameter-radio">
                    <input type="radio" id="diameter-1.75" name="diameter" value="1.75" required>
                    <label id="diameter1" for="diameter-1.75">1.75mm</label>
                    <input type="radio" id="diameter-2.85" name="diameter" value="2.85" required>
                    <label id="diameter2" for="diameter-2.85">2.85mm</label>
                </div>
            </div>
            <br>
            <label for="price">Preis:</label>
            <input type="number" id="price" name="price" placeholder="Preis pro Spule" required><br>
            <label for="weight">Gewicht:</label>
            <input type="number" id="weight" name="weight" placeholder="Gewicht der Spule in Gramm" required><br>
            <label for="owner">Besitzer:</label>
            <input type="text" id="owner" name="owner" placeholder="Besitzer der Spule" required><br>
            <label for="anzahl">Anzahl Spulen:</label>
            <input type="number" id="anzahl" name="anzahl" value="1" required><br>
            <label for="bedtemp">Bed-temp.:</label>
            <input type="number" id="bedtemp" name="bedtemp" value="60" required><br>
            <label for="nozzletemp">Nozzle-temp.:</label>
            <input type="number" id="nozzletemp" name="nozzletemp" value="220" required><br>
            <label for="img">Bild vom Benchy:</label>
            <input type="file" id="img" name="img"><br>
            <label for="img2">Bild von der Spule:</label>
            <input type="file" id="img2" name="img2"><br>
            <label for="additionalinfo">Zusätzliche Infos:</label>
            <textarea id="additionalinfo" name="additionalinfo" placeholder="Tips" rows="4"></textarea><br>
            <div id="buttons">
                <button id="savebtn" type="submit">speichern</button>
                <button id="resetbtn" type="reset">reset</button>
            </div>
        </form>
        
        <?php
        $allowedimgtypes = array("png", "jpeg", "jpg", "ico");
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
            // Handle file uploads
            $benchyImg = $_FILES['img']['name'];
            $img_extention = pathinfo($benchyImg, PATHINFO_EXTENSION);
            if(in_array($img_extention, $allowedimgtypes)){
                $tmpNameBenchy = $_FILES['img']['tmp_name'];
                $benchyImgName = $id . '.benchy.' . $img_extention;
                $targetpathBenchy = "../assets/img/uploads/" . $benchyImgName;
                if (move_uploaded_file($tmpNameBenchy, $targetpathBenchy)) {
                } else {
                    echo "Error - Benchy image not uploaded.<br>";
                }
            }else{
                echo "Filetype not supported";
            }
            $spoolImg = $_FILES['img2']['name'];
            $img2_extention = pathinfo($spoolImg, PATHINFO_EXTENSION);
            if(in_array($img2_extention, $allowedimgtypes)){
                $tmpNameSpool = $_FILES['img2']['tmp_name'];
                $spoolImgName = $id . '.spool.' . $img2_extention;
                $targetpathSpool = "../assets/img/uploads/" . $spoolImgName;
                if (move_uploaded_file($tmpNameSpool, $targetpathSpool)) {
                } else {
                    echo "Error - Spool image not uploaded.<br>";
                }
            }else{
                echo "Filetype not supported";
            }
            $additionalinfo = $_POST['additionalinfo'];

            // Database connection
            $conn = new PDO('sqlite:../assets/db/ff.db', "", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,));

            // Check connection
            //if ($conn->connect_error) {
              //  die("Connection failed: " . $conn->connect_error);
            //}

            // Insert data into the database
            $sql = "INSERT INTO filament (hersteller, farbe, material, dicke, price, gewicht, besitzer, anzahl, bedtemp, nozzletemp, benchyImg, spoolImg, additionalinfo) 
                    VALUES ('$hersteller', '$farbe', '$material', '$dicke', '$price', '$gewicht', '$besitzer', '$anzahl', '$bedtemp', '$nozzletemp', '$benchyImgName', '$spoolImgName', '$additionalinfo')";

            if ($conn->query($sql) === TRUE) {
                header("Location: ../index.php");
                exit;
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
            }

            //$conn->close();
        }
        ?>
    </div>
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</html>