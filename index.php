<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB</title>
    <link rel="icon" href="assets/icons/web-icon.png">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search">
</head>
<body>
       
    <div id="header">
        <div id="inner-header">
            <a id="logo" href="#" class="center">
                <img id="logoimg" src="assets/icons/filament-DB.png" alt="Filament-DB" title="Home">
            </a>
            <div id="suche" class="center">
                <input id="text-input" type="text" placeholder="Suche oder token eingeben..">
                <button id="search-btn"><span class="material-symbols-outlined center">search</span></button>
            </div>
            <div id="user" class="center">
                <div id="user-name">
                    Hallo <i>Gast</i>
                </div>
                <div id="user-profile-img">
                    <img src="assets/icons/user.png" title="Gast" alt="Gast">
                </div>
            </div>
        </div>
    </div>
    <div id="main">
        <?php
            echo "Let's see, if this works!<br>";
            echo "Yes, it does.";
        ?> 
    </div>
</body>
</html>