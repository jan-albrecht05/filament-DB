<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
</head>
<body>
<?php
// Only allow admins
if (!isset($_SESSION['rolle']) || $_SESSION['rolle'] !== 'admin') {
    header("Location: login.php?redirect=admin-panel.php");
    exit;
}

// --- Handle Add User ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $db = new SQLite3("../assets/db/users.db");
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rolle = $_POST['rolle'];
    $profileImgName = '';

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowedimgtypes = array("png", "jpeg", "jpg", "JPG", "ico");
        $img_extention = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($img_extention), $allowedimgtypes)) {
            $profileImgName = $username . '.' . $img_extention;
            $targetpathProfileImage = "../assets/img/uploads/users/" . $profileImgName;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetpathProfileImage);
        }
    }

    // Check if username exists
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

// --- Handle Delete User ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $db = new SQLite3("../assets/db/users.db");
    $user_id = $_POST['delete_user_id'];
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindValue(':id', $user_id, SQLITE3_INTEGER);
    if ($stmt->execute()) {
        header("Location: admin-panel.php");
        exit;
    } else {
        echo "<div style='color:red;'>Fehler beim Löschen!</div>";
    }
}

// --- Handle Edit User ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $db = new SQLite3("../assets/db/users.db");
    $user_id = intval($_POST['edit_user_id']);
    $username = trim($_POST['username']);
    $rolle = $_POST['rolle'];
    $fields = ['username = :username', 'rolle = :rolle'];
    $params = [
        ':username' => $username,
        ':rolle' => $rolle,
        ':id' => $user_id
    ];

    // If password is set, update it
    if (!empty($_POST['password'])) {
        $fields[] = 'password = :password';
        $params[':password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowedimgtypes = array("png", "jpeg", "jpg", "JPG", "ico");
        $img_extention = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($img_extention), $allowedimgtypes)) {
            $profileImgName = $username . '.' . $img_extention;
            $targetpathProfileImage = "../assets/img/uploads/users/" . $profileImgName;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetpathProfileImage);
            $fields[] = 'profile_picture = :profile_picture';
            $params[':profile_picture'] = $profileImgName;
        }
    }

    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
    $stmt = $db->prepare($sql);
    foreach ($params as $key => $value) {
        if ($key === ':id') {
            $stmt->bindValue($key, $value, SQLITE3_INTEGER);
        } else {
            $stmt->bindValue($key, $value, SQLITE3_TEXT);
        }
    }
    if ($stmt->execute()) {
        header("Location: admin-panel.php");
        exit;
    } else {
        echo "<div style='color:red;'>Fehler beim Bearbeiten!</div>";
    }
}
?>
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
        $db = new SQLite3("../assets/db/users.db");
        $result = $db->query("SELECT * FROM users");
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
            echo '    <form method="post" style="display:inline;">';
            echo '      <button type="button" class="edit-user-btn"
                            data-id="' . htmlspecialchars($user['id']) . '"
                            data-username="' . htmlspecialchars($user['username']) . '"
                            data-rolle="' . htmlspecialchars($user['rolle']) . '"
                            data-profile_picture="' . htmlspecialchars($user['profile_picture']) . '">
                            <span class="material-symbols-outlined">edit</span>
                        </button>';
            echo '      <input type="hidden" name="delete_user_id" value="' . htmlspecialchars($user['id']) . '">';
            echo '      <button id="delete" type="submit" name="delete_user" onclick="return confirm(\'Diesen Benutzer wirklich löschen?\');">';
            echo '        <span class="material-symbols-outlined">delete</span>';
            echo '      </button>';
            echo '    </form>';
            echo '  </div>';
        }
        ?>
    </div>
    <div class="popup" id="add-user-popup" style="display:none;">
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
    <div class="popup" id="edit-user-popup" style="display:none;">
        <form id="edit-user-form" method="POST" action="" enctype="multipart/form-data">
            <h2>Benutzer bearbeiten</h2>
            <input type="hidden" name="edit_user_id" value="">
            <label for="edit-username">Benutzername:</label>
            <input type="text" id="edit-username" name="username" required><br>
            <label for="edit-password">Passwort:</label>
            <input type="password" id="edit-password" name="password" placeholder="Nur ausfüllen, wenn ändern" autocomplete="new-password"><br>
            <label for="edit-role">Rolle:</label>
            <select id="edit-role" name="rolle" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select><br>
            <label for="edit-profile_picture">Profilbild:</label>
            <input type="file" name="profile_picture" id="edit-profile_picture"><br>
            <img id="current-profile-pic" src="" alt="Aktuelles Profilbild" style="max-width:80px;display:none;"><br>
            <button type="submit" name="edit_user">Aktualisieren</button>
            <button type="button" id="close-popup-edit">Abbrechen</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("add-user").onclick = function() {
                document.getElementById("add-user-popup").style.display = "flex";
            };
            document.getElementById("close-popup").onclick = function() {
                document.getElementById("add-user-popup").style.display = "none";
            };
            document.getElementById("close-popup-edit").onclick = function() {
                document.getElementById("edit-user-popup").style.display = "none";
            };

            // Edit user popup logic
            document.querySelectorAll(".edit-user-btn").forEach(function(btn) {
                btn.onclick = function() {
                    document.getElementById("edit-user-popup").style.display = "flex";
                    document.getElementById("edit-user-form").reset();
                    document.getElementById("edit-user-form").elements["edit_user_id"].value = btn.dataset.id;
                    document.getElementById("edit-username").value = btn.dataset.username;
                    document.getElementById("edit-role").value = btn.dataset.rolle;
                    // Show current profile picture if available
                    let img = document.getElementById("current-profile-pic");
                    if (btn.dataset.profile_picture) {
                        img.src = "../assets/img/uploads/users/" + btn.dataset.profile_picture;
                        img.style.display = "block";
                    } else {
                        img.style.display = "none";
                    }
                };
            });
        });
    </script>
</body>
</html>