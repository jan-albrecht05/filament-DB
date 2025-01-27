<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search">
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/user.js" defer></script>
    
</head>
<body>
    <div id="header"><!--Code injectedd via assets/js/heading.js--></div>
    <div id="user-settings"><!--Code injected via assets/js/user.js--></div>
</div>
<div id="main">
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
</html>