<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="../assets/js/user.js" defer></script>
</head>
<body>
    <div id="header">
        <div id="inner-header">
            <a id="logo" href="../index.php" class="center">
                <img id="logoimg" src="../assets/icons/filament-DB.png" alt="Filament-DB" title="Home">
            </a>
        </div>
    </div>
    <div id="main">
        <button id="add-user">
            <span class="material-symbols-outlined">add</span> Benutzer hinzufügen
        </button>
        <div class="user" id="user-heading">
            <h2>Profilbild</h2>
            <h2>Benutzername</h2>
            <h2>Rolle</h2>
            <div style="width: 12rem"></div>
        </div>
        <?php
        // Connect to the users.db SQLite database
        $db = new SQLite3("../assets/db/users.db");

        // Example: Fetch all users
        $result = $db->query("SELECT * FROM users");

        // Output user data
        while ($user = $result->fetchArray(SQLITE3_ASSOC)) {
            echo '<div class="user">';
            echo '  <div id="user-icon">';
            $default_img = 'assets/icons/user.png';
            $profile_img = !empty($user['profile_picture'])
            ? 'assets/img/uploads/users/' . $user['profile_picture']
            : $default_img;
            echo '<img src="../' . htmlspecialchars($profile_img) . '" alt="">';
            echo '  </div>';
            echo '  <div id="username">';
            echo '    <span>' . htmlspecialchars($user['username']) . '</span>';
            echo '  </div>';
            echo '  <div id="role">';
            echo '    <span id="user-role">' . htmlspecialchars($user['rolle']) . '</span>';
            echo '  </div>';
            echo '  <div id="user-setting">';
            echo '    <button id="user_settings">';
            echo '      <span class="material-symbols-outlined">settings</span>';
            echo '    </button>';
            echo '    <form method="post" style="display:inline;" onsubmit="return confirm(\'Diesen Benutzer wirklich löschen?\');">';
            echo '      <input type="hidden" name="delete_user_id" value="' . htmlspecialchars($user['id']) . '">';
            echo '      <button id="delete" type="submit" name="delete_user">';
            echo '        <span class="material-symbols-outlined">delete</span>';
            echo '      </button>';
            echo '    </form>';
            echo '  </div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="popup" id="add-user-popup">
        <form id="add-user-form" method="POST" action="" enctype="multipart/form-data">
                <h2>Benutzer hinzufügen</h2>
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="role">Rolle:</label>
                <select id="role" name="rolle" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select><br>
                <label for="profile_picture">Profilbild:</label>
                <input type="file" name="profile_picture" id="profile_picture"><br>
                <button type="submit" name="add_user">Hinzufügen</button>
                <button type="button" id="close-popup">Abbrechen</button>
            </form>
    </div>
    <?php
    $allowedimgtypes = array("png", "jpeg", "jpg", "JPG", "ico");
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
        $db = new SQLite3("../assets/db/users.db");
        $username = trim($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $rolle = $_POST['rolle'];

        // Handle file uploads
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $profile_picture = $_FILES['profile_picture']['name'];
            $img_extention = pathinfo($profile_picture, PATHINFO_EXTENSION);
            if(in_array($img_extention, $allowedimgtypes)){
                $tmpName = $_FILES['profile_picture']['tmp_name'];
                $profileImgName = $username . '.' . $img_extention;
                $targetpathProfileImage = "../assets/img/uploads/users/" . $profileImgName;
                if (move_uploaded_file($tmpName, $targetpathProfileImage)) {
                } else {
                    echo "Error - Profileimage not uploaded.<br>";
                }
            }else{
                echo "Filetype not supported";
            }
        }

        // Check if username already exists
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $res = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if ($res['count'] > 0) {
            echo "<div style='color:red;'>Benutzername existiert bereits!</div>";
        } else {
            $stmt = $db->prepare("INSERT INTO users (username, password, rolle, profile_picture) VALUES (:username, :password, :rolle, :profile_picture)");
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $password, SQLITE3_TEXT);
            $stmt->bindValue(':rolle', $rolle, SQLITE3_TEXT);
            $stmt->bindValue(':profile_picture', $profileImgName, SQLITE3_TEXT);
            if ($stmt->execute()) {
                header("Location: admin-panel.php");
                exit;
            } else {
                echo "<div style='color:red;'>Fehler beim Hinzufügen!</div>";
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
        $db = new SQLite3("../assets/db/users.db");
        $user_id = $_POST['delete_user_id'];

        // Delete the user
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $user_id, SQLITE3_INTEGER);
        if ($stmt->execute()) {
            header("Location: admin-panel.php");
            exit;
        } else {
            echo "<div style='color:red;'>Fehler beim Löschen!</div>";
        }
    }
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("add-user").onclick = function() {
                document.getElementById("add-user-popup").style.display = "flex";
            };
            document.getElementById("close-popup").onclick = function() {
                document.getElementById("add-user-popup").style.display = "none";
            };
        });
    </script>
</body>
</html>