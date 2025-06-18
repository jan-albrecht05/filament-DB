<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament DB  - Suche nach "<?php echo htmlspecialchars($_GET['query']); ?>"</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
    <script src="../assets/js/footer.js" defer></script>
    <script src="../assets/js/mode.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("#filament-output .filament").forEach(function(item) {
                item.addEventListener("click", function() {
                    const clickedElementId = this.id;
                    if (clickedElementId != "filamentheading"){
                        location.href = "../pages/filament.php?id=" + clickedElementId;
                    }
                });
            });
        });
    </script>    
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
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
                </div>
            </div>
        </div>
        <div id="filament-output">
            <?php
            if (isset($_GET['query'])) {
                $query = $_GET['query'];
                // Verbindung zur SQLite-Datenbank herstellen
                $db = new SQLite3('../assets/db/ff.db');
                // Sicherheitsmaßnahme: vorbereitete SQL-Anweisung (um SQL-Injection zu vermeiden)
                $stmt = $db->prepare("SELECT * FROM filament WHERE hersteller LIKE :search OR material LIKE :search OR farbe LIKE :search OR dicke LIKE :search OR price LIKE :search OR gewicht LIKE :search OR besitzer LIKE :search OR anzahl LIKE :search OR bedtemp LIKE :search OR nozzletemp LIKE :search");
                $stmt->bindValue(':search', '%' . $query . '%', SQLITE3_TEXT);
                $results = $stmt->execute();

                while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                    echo '<div class="filament" id="'.htmlspecialchars($row['id']).'">
                                <div class="img">';
                                    if (!empty($row['benchyImg'])) {
                                        echo '<img id="benchy" src="../assets/img/uploads/'.htmlspecialchars($row['benchyImg']).'" alt="">';
                                        echo '<img id="spool" src="../assets/img/uploads/'.htmlspecialchars($row['spoolImg']).'" alt="">';
                                    }
                                echo '</div>
                                <div class="box">
                                    <div class="row">
                                        <div class="hersteller">'.htmlspecialchars($row['hersteller']).'</div>
                                        <div class="material">'.htmlspecialchars($row['material']).'</div>
                                        <div class="farbe"><nobr><span class="colordot" style="background-color:'.htmlspecialchars($row['farbe']).'"></span>'.htmlspecialchars($row['farbe']).'</nobr></div>
                                        <div class="durchmesser">'.htmlspecialchars($row['dicke']).'mm</div>
                                    </div>
                                    <div class="row">
                                        <div class="preis">'.htmlspecialchars($row['price']).'€</div>
                                        <div class="gewicht">'.htmlspecialchars($row['gewicht']).'g</div>
                                        <div class="besitzer">'.htmlspecialchars($row['besitzer']).'</div>
                                        <div class="anzahl">'.htmlspecialchars($row['anzahl']).'</div>
                                        <div class="bedtemp center"><span class="material-symbols-outlined">heat</span>'.htmlspecialchars($row['bedtemp']).'°C</div>
                                        <div class="nozzletemp center"><span class="material-symbols-outlined center">arrow_downward</span>'.htmlspecialchars($row['nozzletemp']).'°C</div>
                                    </div>
                                </div>    
                            </div>';
                }
            }
            ?> 
        </div>
    </div>
    <footer id="footer" class="center">
        <div id="footer-content">
        <!--code gets injected by footer.js-->
        </div>
    </footer>
</body>
</html>