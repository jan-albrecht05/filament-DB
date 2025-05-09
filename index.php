<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament DB</title>
    <link rel="icon" href="assets/icons/web-icon.png">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="assets/js/heading.js"></script>
    <script src="assets/js/user.js" defer></script>
    <script src="assets/js/footer.js" defer></script>
    <script src="assets/js/mode.js" defer></script>
    <script src="assets/js/links.js" defer></script>
    <script src="assets/js/cookies.js" defer></script>
    <style>
        @media (min-height:500px) {
            #footer{
                position: absolute;
            }
        }
    </style>
</head>
<body>
    <div id="header"><!--Code injected via assets/js/heading.js--></div>
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
            <div class="img" style="text-align:center">Bild</div>
            <div class="box">
                <div class="row">
                    <button class="hersteller"><span class="text">Hersteller</span><span class="line"></span></button>
                    <button class="material"><span class="text">Material</span><span class="line"></span></button>
                    <div class="farbe">Farbe</div>
                    <div class="durchmesser">Durchmesser</div>
                </div>
                <div class="row">
                    <button class="preis"><span class="text">Preis</span><span class="line"></span></button>
                    <button class="gewicht"><span class="text">Gewicht</span><span class="line"></span></button>
                    <div class="besitzer">Besitzer</div>
                    <div class="anzahl">Anzahl</div>
                    <div class="bedtemp">Bedtemp.</div>
                    <div class="nozzletemp">Nozzletemp.</div>
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
                    $result = $db->query("SELECT * FROM filament");// WHERE name like *

                    // Check if there are any rows returned
                    if ($result) {
                        $hasRows = false;
                        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                            $hasRows = true;
                            echo '
                            <div class="filament" id="'.$row['id'].'">
                                <div class="img"></div>
                                <div class="box">
                                    <div class="row">
                                        <div class="hersteller">'.$row['hersteller'].'</div>
                                        <div class="material">'.$row['material'].'</div>
                                        <div class="farbe"><nobr><span class="colordot" style="background-color:'.$row['farbe'].'"></span>'.$row['farbe'].'</nobr></div>
                                        <div class="durchmesser">'.$row['dicke'].'mm</div>
                                    </div>
                                    <div class="row">
                                        <div class="preis">'.$row['price'].'€</div>
                                        <div class="gewicht">'.$row['gewicht'].'g</div>
                                        <div class="besitzer">'.$row['besitzer'].'</div>
                                        <div class="anzahl">'.$row['anzahl'].'</div>
                                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>'.$row['bedtemp'].'°C</div>
                                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>'.$row['nozzletemp'].'°C</div>
                                    </div>
                                </div>    
                            </div>';
                        }
                        if (!$hasRows) {
                            echo "<a href='pages/add.php' class='center' id='addfilamentbtn' title='Filament Hinzufügen'>+</a>";
                        }
                    }
                } else {
                    echo "<a href='pages/add.php' class='center' id='addfilamentbtn' title='Filament Hinzufügen'>+</a>";
                }
            ?>
        </div>
    </div>
    <div id="cookies">
        <div id="cookies-content">
            <p>Diese Website verwendet Cookies.<br><a href="pages/FAQ.html#cookie-frage" class="center"><u>weitere Informationen</u><span class="material-symbols-outlined">open_in_new</span></a></p>
            <button onclick="AcceptCookies()">okay</button>
        </div>
    </div>
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</html>