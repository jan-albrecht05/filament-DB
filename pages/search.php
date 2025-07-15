<!DOCTYPE html>
<html lang="de">
<head>
    <?php
    session_start();
    $db = new SQLite3("../assets/db/ff.db");

    $allowed_columns = ['id','hersteller','material','farbe','dicke','price','gewicht','besitzer','anzahl','bedtemp','nozzletemp'];
    $sort = isset($_POST['sort']) ? $_POST['sort'] : (isset($_SESSION['sort']) ? $_SESSION['sort'] : 'id');
    $order = isset($_POST['order']) ? $_POST['order'] : (isset($_SESSION['order']) ? $_SESSION['order'] : 'ASC');
    function sort_arrow($column, $sort, $order) {
        if ($column !== $sort) return '';
        return $order === 'ASC' ? ' <span class="material-symbols-outlined">keyboard_control_key</span>' : '  <span class="material-symbols-outlined">keyboard_arrow_down</span>';
    }
    $search = isset($_POST['query']) ? trim($_POST['query']) : (isset($_GET['query']) ? trim($_GET['query']) : '');
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
        <form class="filament" id="filamentheading" method="POST" action="?query=<?php echo urlencode($search); ?>">
            <div class="img" style="text-align:center">Bild</div>
            <div class="box">
                <div class="row">
                    <button class="hersteller" type="submit" name="sort" value="hersteller"><span class="text">Hersteller<?php echo sort_arrow('hersteller', $sort, $order); ?></span><span class="line"></span></button>
                    <button class="material" type="submit" name="sort" value="material"><span class="text">Material<?php echo sort_arrow('material', $sort, $order); ?></span><span class="line"></span></button>
                    <div class="farbe">Farbe</div>
                    <div class="durchmesser">Durchmesser</div>
                </div>
                <div class="row">
                    <button class="preis" type="submit" name="sort" value="price"><span class="text">Preis<?php echo sort_arrow('price', $sort, $order); ?></span><span class="line"></span></button>
                    <button class="gewicht" type="submit" name="sort" value="gewicht"><span class="text">Gewicht<?php echo sort_arrow('gewicht', $sort, $order); ?></span><span class="line"></span></button>
                    <div class="besitzer">Besitzer</div>
                    <div class="anzahl">Anzahl</div>
                    <div class="bedtemp">Bedtemp.</div>
                    <div class="nozzletemp">Nozzletemp.</div>
                </div>
            </div>
            <input type="hidden" name="order" value="<?php
                if (isset($_POST['sort']) && isset($_POST['order']) && $_POST['sort'] === $_POST['last_sort']) {
                    echo $_POST['order'] === 'DESC' ? 'ASC' : 'DESC';
                } else {
                    echo 'DESC';
                }
            ?>">
            <input type="hidden" name="last_sort" value="<?php echo isset($_POST['sort']) ? $_POST['sort'] : ''; ?>">
            <input type="hidden" name="query" value="<?php echo htmlspecialchars($search); ?>">
        </form>
        <div id="filament-output">
            <?php

            $where = ["active = 1"];

            if ($search !== '') {
                $search_esc = SQLite3::escapeString($search);
                $where[] = "(CAST(id AS INTEGER) = CAST('$search_esc' AS INTEGER) OR hersteller LIKE '%$search_esc%' OR material LIKE '%$search_esc%' OR farbe LIKE '%$search_esc%' OR besitzer LIKE '%$search_esc%')";
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
                                    }else{
                                        echo '<img id="benchy" src="../assets/icons/no-benchy.png" alt="">';
                                    }
                                    if (!empty($row['spoolImg'])) {
                                        echo '<img id="spool" src="../assets/img/uploads/'.htmlspecialchars($row['spoolImg']).'" style="background-image:none" alt="">';
                                    }else{
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
                echo "<div style='margin-top: 1rem'>Keine Ergebnisse gefunden.<br>";
                if (!isset($_SESSION['user_id'])) {
                    echo "<a href='../pages/login.php?redirect=search.php?query=".$search."'>Melde dich an.</a>";
                }
                echo "</div>";
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