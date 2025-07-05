<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    ?>
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
    <script>
        let loggedInUser = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
        let loggedInUserImg = <?php echo isset($_SESSION['profile_picture']) ? json_encode($_SESSION['profile_picture']) : 'null'; ?>;
    </script>
    <style>
        a{
            color: var(--user-main-color);
        }
    </style>
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
            if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        ?>
        <?php
            //check if filament is inactive (spool emty)
                if ($row['active'] == 0) {
                    echo '<div id="inactive-banner"> <span class="material-symbols-outlined">info</span><span>Dieser Eintrag ist inaktiv!</span></div>';
                }
        ?>
        <?php
        // Handle deactivate action
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deaktivieren') {
                $stmt = $db->prepare("UPDATE filament SET active = 0 WHERE id = :id");
                $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
                $stmt->execute();
                // Optional: reload the page to show the inactive banner
                header("Location: filament.php?id=" . $id);
                exit;
            }
        ?>
        <?php
            // Only show if user is logged in OR besitzer is Homburgschule
            if (!isset($_SESSION['user_id']) && $row['besitzer'] !== 'Homburgschule') {
                echo "<p>Du musst eingeloggt sein, um diesen Eintrag zu sehen.</p>";
                // Optionally, add a login link:
                echo "<a href='login.php?redirect=filament.php?id=" . urlencode($row['id']) . "'>Jetzt einloggen</a>";
            } else {
                ?>
                <div id="page">
                    <div id="left">
                        <div id="benchyImg" class="image">
                            <img id="benchy" src="../assets/img/uploads/<?php echo htmlspecialchars($row['benchyImg']); ?>" onerror="this.onerror=null; this.src='../assets/icons/no-benchy.png';" alt="">
                        </div>
                        <div id="SpoolImg" class="image">
                            <img id="spool" src="../assets/img/uploads/<?php echo htmlspecialchars($row['spoolImg']); ?>" onerror="this.onerror=null; this.src='../assets/icons/no-spool.png';" alt="">
                        </div>
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
                        <?php 
                        if (isset($_SESSION['rolle']) ? "admin" : "user" === "admin") {
                            $deactivateClass = ($row['active'] == 0) ? 'inactive' : '';
                            $deactivateDisabled = ($row['active'] == 0) ? 'disabled' : '';
                            echo '
                                <form id="buttons" method="post">
                                    <button id="edit" type="button" onclick="window.location.href=\'edit.php?id='.$row['id'].'\'">bearbeiten</button>
                                    <button id="deaktivieren" name="action" value="deaktivieren" type="submit" class="'.$deactivateClass.'" '.$deactivateDisabled.'>deaktivieren</button>
                                </form>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            } else {
                echo "<p>Keine Ergebnisse für ID #" . htmlspecialchars($id) . " gefunden.</p>";
            }
            // Close the connection
            $stmt->close();
            $db->close();
        ?>
    </div>
    <footer id="footer" class="center">
        <div id="footer-content">
            <!--code gets injected by footer.js-->
        </div>
    </footer>
</body>
</html>