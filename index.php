<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB</title>
    <link rel="icon" href="assets/icons/web-icon.png">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="assets/js/heading.js"></script>
    <script src="assets/js/user.js" defer></script>
    <script src="assets/js/footer.js" defer></script>
    <script src="assets/js/mode.js" defer></script>
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    <div id="main">
        <div id="controls">
            <button id="addbtn" onclick="location = 'pages/add.php'">Hinzufügen</button>
            <div id="toggleswitch">
                <button id="listbtn" class="togglebtn active center" onclick="listmode()"><span class="material-symbols-outlined">toc</span></button>
                <button id="gridbtn" class="togglebtn center" onclick="gridmode()"><span class="material-symbols-outlined">view_cozy</span></button>
            </div>
        </div>
        <div id="modecss" hidden><!--CSS for Filament-view gets inserted here via /assets/js/mode.js--></div>
        <div class="filament" id="filamentheading">
            <div class="img center">Bild</div>
            <div class="box">
                <div class="row">
                    <div class="hersteller">Hersteller</div>
                    <div class="material">Material</div>
                    <div class="farbe">Farbe</div>
                    <div class="durchmesser">Durchmesser</div>
                </div>
                <div class="row">
                    <div class="preis">Preis</div>
                    <div class="gewicht">Gewicht</div>
                    <div class="besitzer">Besitzer</div>
                    <div class="anzahl">Anzahl</div>
                    <div class="bedtemp center">Bedtemp.</div>
                    <div class="nozzletemp center">Nozzletemp.</div>
                    <div class="additionalinfo"><!--PHP: Additional Info--></div>
                    </div>
                </div>
            </div>
        <div id="filament-output">
    	<!--PHP: Filament-Output--> 
            <?php
                // Open the sqlite3 database file only if it already exists
                if(file_exists("assets/db/ff.db")){
                    $db = new SQLite3("assets/db/ff.db");

                    // Query to select all data from the filament table
                    $result = $db->query("SELECT * FROM filament");

                    // Check if there are any rows returned
                    if ($result) {
                        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                            echo'
                            <div class="filament" id="'.$row['id'].'">
                                <div class="img"></div>
                                <div class="box">
                                    <div class="row">
                                        <div class="hersteller">'.$row['hersteller'].'</div>
                                        <div class="material">'.$row['material'].'</div>
                                        <div class="farbe">'.$row['farbe'].'</div>
                                        <div class="durchmesser">'.$row['dicke'].'mm</div>
                                    </div>
                                    <div class="row">
                                        <div class="preis">'.$row['price'].'€</div>
                                        <div class="gewicht">'.$row['gewicht'].'g</div>
                                        <div class="besitzer">'.$row['besitzer'].'</div>
                                        <div class="anzahl">'.$row['anzahl'].'</div>
                                        <div class="bedtemp center">'.$row['bedtemp'].'°C</div>
                                        <div class="nozzletemp center">'.$row['nozzletemp'].'°C</div>
                                    </div>
                                </div>    
                            </div>';
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</html>