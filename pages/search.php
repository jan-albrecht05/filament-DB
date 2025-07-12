<!DOCTYPE html>
<html lang="de">
<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament DB  - Suche nach "<?php echo htmlspecialchars($_GET['query']); ?>"</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <script src="../assets/js/user.js" defer></script>
    <script src="../assets/js/footer.js" defer></script>
    <script src="../assets/js/links2.js" defer></script>
    <script src="../assets/js/mode.js" defer></script>
    <script src="../assets/js/heading.js"></script>
    <script>
        let loggedInUser = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
        let loggedInUserImg = <?php echo isset($_SESSION['profile_picture']) && $_SESSION['profile_picture'] ? json_encode($_SESSION['profile_picture']) : 'null'; ?>;
        let searchTerm = <?php echo isset($_GET['query']) ? json_encode($_GET['query']) : '""'; ?>;
    </script>
    <style>
        a{
            color: var(--user-main-color);
        }
    </style>
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
    <div id="main">
        <div id="controls">
            <?php 
            if (isset($_SESSION['rolle']) && $_SESSION['rolle'] === "admin") {
                echo '<button id="addbtn" onclick="location=\'pages/add.php\'">Hinzufügen</button>';
            } else {
                echo '<span></span>';
            }
            ?>
            <div id="toggleswitch">
                <button id="listbtn" class="togglebtn active center" onclick="listmode()"><span class="material-symbols-outlined">toc</span></button>
                <button id="gridbtn" class="togglebtn center" onclick="gridmode()"><span class="material-symbols-outlined">view_cozy</span></button>
            </div>
        </div>
        <div id="modecss" hidden>
            <!--CSS for Filament-view gets inserted here via /assets/js/mode.js-->
            <link rel="stylesheet" href="../assets/css/list.css">
        </div>
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
            $db = new SQLite3("../assets/db/ff.db");

            $allowed_columns = ['id','hersteller','material','farbe','dicke','price','gewicht','besitzer','anzahl','bedtemp','nozzletemp'];
            $sort = isset($_POST['sort']) && in_array($_POST['sort'], $allowed_columns) ? $_POST['sort'] : 'id';
            $order = isset($_POST['order']) && $_POST['order'] === 'ASC' ? 'ASC' : 'DESC';

            // Get search term
            $search = isset($_GET['query']) ? trim($_GET['query']) : '';
            $where = ["active = 1"];

            if ($search !== '') {
                $search_esc = SQLite3::escapeString($search);
                $where[] = "(id LIKE '%$search_esc%' OR hersteller LIKE '%$search_esc%' OR material LIKE '%$search_esc%' OR farbe LIKE '%$search_esc%' OR besitzer LIKE '%$search_esc%')";
            } else {
                echo '<p class="error">Bitte gib einen Suchbegriff ein.</p>';
                exit;
            }

            // Only show Homburgschule filaments if not logged in
            if (!isset($_SESSION['user_id'])) {
                $where[] = "besitzer = 'Homburgschule'";
            }

            $where_sql = 'WHERE ' . implode(' AND ', $where);

            $query = "SELECT * FROM filament $where_sql ORDER BY $sort $order";
            $result = $db->query($query);

            $hasRows = false;
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $hasRows = true;
                echo '<div class="filament" id="'.htmlspecialchars($row['id']).'">
                            <div class="img">';
                                    if (!empty($row['benchyImg'])) {
                                        echo '<img id="benchy" src="../assets/img/uploads/'.htmlspecialchars($row['benchyImg']).'" style="background-image:none" alt="">';
                                        echo '<img id="spool" src="../assets/img/uploads/'.htmlspecialchars($row['spoolImg']).'" style="background-image:none" alt="">';
                                    }else{
                                        echo '<img id="benchy" src="../assets/icons/no-benchy.png" alt="">';
                                        echo '<img id="spool" src="../assets/icons/no-spool.png" alt="">';
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
            if (!$hasRows) {
                echo "<div style='margin-top: 1rem'>Keine Ergebnisse gefunden.</div>";
                if (!isset($_SESSION['user_id'])) {
                    echo "<a href='../pages/login.php?redirect=search.php?query=".$search."'>Melde dich an.</a>";
            }}
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