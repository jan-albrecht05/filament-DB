<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
    <script src="../assets/js/footer.js" defer></script>
    <script src="../assets/js/mode.js" defer></script>
    <style>
        @media (min-height:200px) {
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
    <div id="controls">
            <button id="addbtn" onclick="location = '../pages/add.php'">Hinzufügen</button>
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
        </div>
    <?php
            if (isset($_GET['query'])) {
                $query = $_GET['query'];
                // Perform the search using the $query value
                echo "Deine Suche nach: <b>" . htmlspecialchars($query) . "</b> ergab <i>noch</i> keine Treffer.";
                echo "<title>filament DB - Suche nach " . htmlspecialchars($query) . "</title>";
                // Add your search logic here
            } else {
                echo "No search query provided.";
                echo "<title>Filament DB - Suche</title>";
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