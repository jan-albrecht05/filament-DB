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
        <?php
            $sort = isset($_POST['sort']) ? $_POST['sort'] : (isset($_SESSION['sort']) ? $_SESSION['sort'] : 'id');
            $order = isset($_POST['order']) ? $_POST['order'] : (isset($_SESSION['order']) ? $_SESSION['order'] : 'ASC');
            function sort_arrow($column, $sort, $order) {
                if ($column !== $sort) return '';
                return $order === 'ASC' ? ' <span class="material-symbols-outlined">keyboard_control_key</span>' : '  <span class="material-symbols-outlined">keyboard_arrow_down</span>';
            }
        ?>
        <div id="modecss" hidden><!--CSS for Filament-view gets inserted here via /assets/js/mode.js--></div>
        <form class="filament" id="filamentheading" method="POST">
            <div class="img" style="text-align:center">Bild</div>
            <div class="box">
                <div class="row">
                    <button class="hersteller" type="submit" name="sort" value="hersteller"><span class="text">Hersteller<?php echo sort_arrow('hersteller', $sort, $order); ?></span><span class="line"></span></button>
                    <button class="material" type="submit" name="sort" value="material"><span class="text">Material<?php echo sort_arrow('material', $sort, $order); ?></span><span class="line"></span></button>
                    <div class="farbe">Farbe</div>
                    <div class="durchmesser">Durchmesser</div>
                </div>
                <div class="row">
                    <button class="preis" type="submit" name="sort" value="preis"><span class="text">Preis <?php echo sort_arrow('preis', $sort, $order); ?></span><span class="line"></span></button>
                    <button class="gewicht" type="submit" name="sort" value="gewicht"><span class="text">Gewicht <?php echo sort_arrow('gewicht', $sort, $order); ?></span><span class="line"></span></button>
                    <div class="besitzer">Besitzer</div>
                    <div class="anzahl">Anzahl</div>
                    <div class="bedtemp">Bedtemp.</div>
                    <div class="nozzletemp">Nozzletemp.</div>
                    <div class="additionalinfo"><!--PHP: Additional Info--></div>
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
        </form>
        <div id="filament-output">
            <!--PHP: Filament-Output--> 
            <?php
                // Open the sqlite3 database file only if it already exists
                if(file_exists("assets/db/ff.db")){
                    $db = new SQLite3("assets/db/ff.db");

                    // Query to select sorted data from the filament table

                    $allowed_columns = ['id','hersteller','material','farbe','dicke','price','gewicht','besitzer','anzahl','bedtemp','nozzletemp'];
                    $sort = isset($_POST['sort']) && in_array($_POST['sort'], $allowed_columns) ? $_POST['sort'] : 'id';
                    $order = isset($_POST['order']) && $_POST['order'] === 'ASC' ? 'ASC' : 'DESC';

                    $result = $db->query("SELECT * FROM filament ORDER BY $sort $order");

                    // Check if there are any rows returned
                    if ($result) {
                        $hasRows = false;
                        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                            $hasRows = true;
                            echo '
                            <div class="filament" id="'.$row['id'].'">
                                <div class="img">';
                                    if (!empty($row['benchyImg'])) {
                                        echo '<img id="benchy" src="assets/img/uploads/'.htmlspecialchars($row['benchyImg']).'" alt="">';
                                        echo '<img id="spool" src="assets/img/uploads/'.htmlspecialchars($row['spoolImg']).'" alt="">';
                                    }
                                echo '</div>
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
    <footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</body>
</html>