<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=login" />
    <script src="../assets/js/footer.js"></script>
    <script>
        window.onload = () =>{
            footer();
        }
    </script>
    <style>
        @media (min-height:644px) {
            #footer{
                position: absolute;
            }
        }
    </style>
    <script>
        window.addEventListener("load", () =>{
            let color = localStorage.getItem('user-main-color');
            if (color) {
                document.documentElement.style.setProperty('--user-main-color', color);
            }
                let theme = localStorage.getItem('user-theme');
                if (theme == 'dark'){
                    setDarkTheme();
                }
                else{
                    setLightTheme();
                }
            function setDarkTheme() {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
            function setLightTheme() {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })
    </script>
</head>
<body>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $db = new SQLite3("../assets/db/users.db");
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result && password_verify($password, $result['password'])) {
        // Login successful
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['rolle'] = $result['rolle'];
        $_SESSION['profile_picture'] = $result['profile_picture'];
        header("Location: ../index.php");
        exit;
    } else {
        $login_error = "Benutzername oder Passwort falsch!";
    }
}
?>
    <div id="header"><div id="inner-header"><a id="logo" href="../index.php" class="center"><img id="logoimg" src="../assets/icons/filament-DB.png" alt="Filament-DB" title="Home"></a></div></div>
    <div id="main">
        <form id="login-form" method="post" action="">
            <h1>Login</h1>
            <div class="part">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <div class="part">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" placeholder="Password">
                <div class="pass-alert">
                    <?php if (isset($login_error)) echo "<div style='color:red;'>$login_error</div>"; ?>
                </div>
            </div>
            <button type="submit" name="login" id="login-button" class="center">Login<span class='material-symbols-outlined'>login</span></button>
        </form>
    </div>
    
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by footer.js-->
    </div>
</footer>
</html>