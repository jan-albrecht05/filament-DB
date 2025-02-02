<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament DB  - #<?php echo htmlspecialchars($_GET['id']); ?></title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/filament.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
    <script src="../assets/js/footer.js" defer></script>
</head>
<body>
    <div id="header"><!--Code injected via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    <div id="main">
        <?php
            // Database connection
            $db = new SQLite3("../assets/db/ff.db");

            // Get the ID from the URL
            $id = htmlspecialchars($_GET['id']);

            // Prepare and execute the SQL statement
            $stmt = $db->prepare("SELECT * FROM filament WHERE id = :id");
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $result = $stmt->execute();

            // Check if the record exists
            if ($row = $result->fetchArray(SQLITE3_ASSOC)) {} 
            else {
                echo "No results found for ID: " . $id;
            }

            // Close the connection
            $stmt->close();
            $db->close();
        ?>
        <div id="page">
            <div id="left">
                <div id="benchyImg" class="image"></div>
                <div id="SpoolImg" class="image"></div>
            </div>
            <div id="right">
                <p id="ID">ID: <?php echo ($row["id"])?></p>
                <h1 id="hersteller">Hersteller: <?php echo ($row["hersteller"])?></h1>
                <h2 id="material">Material: <?php echo ($row["material"])?></h2>
                <?php echo ('<h3 id="farbe">Farbe: <nobr><span class="colordot" style="background-color:'.$row['farbe'].'"></span>'.$row['farbe'].'</nobr></h3>') ?>
                <h3 id="durchmesser">Durchmesser: <?php echo ($row["dicke"])?>mm</h3>
                <h3 id="preis">Preis: <?php echo ($row["price"])?>€</h3>
                <h3 id="gewicht">Gewicht: <?php echo ($row["gewicht"])?>g</h3>
                <h3 id="besitzer">Besitzer: <?php echo ($row["besitzer"])?></h3>
                <h3 id="anzahl">Anzahl Rollen: <?php echo ($row["anzahl"])?></h3>
                <h2 id="printsettings">Druckeinstellungen:</h2>
                <h3 id="bedtemp"><span class="material-symbols-outlined">heat</span> <?php echo ($row["bedtemp"])?>°C</h3>
                <h3 id="nozzletemp"><span class="material-symbols-outlined">arrow_downward</span> <?php echo ($row["nozzletemp"])?>°C</h3>
                <h2 id="extras">Infos:</h2>
                <p id="additional_info">
                    <?php 
                    if($row["additionalinfo"]){
                        echo ($row["additionalinfo"]);
                    }
                    else{
                        echo "---";
                    }
                    ?>
                </p>
                <div id="buttons">
                    <button id="edit">bearbeiten</button>
                    <button id="deaktivieren">deaktivieren</button>
                </div>
            </div>
        </div>
    </div>
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</html>