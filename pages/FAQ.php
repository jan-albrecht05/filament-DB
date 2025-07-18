<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filament DB - FAQ</title>
    <link rel="icon" href="../assets/icons/web-icon.png">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/faq.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <script src="../assets/js/heading.js"></script>
    <script src="../assets/js/footer.js" defer></script>
    <script src="../assets/js/user.js" defer></script>
    <script>
        let loggedInUser = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
        let loggedInUserImg = <?php echo isset($_SESSION['profile_picture']) ? json_encode($_SESSION['profile_picture']) : 'null'; ?>;
    </script>
    <script>
        document.addEventListener("load", () =>{
           footer()
        });
        function openCookieMenu() {
            document.getElementById('cookie-del-frage').style.display = "block";
        }
    </script>
    <script>
        window.addEventListener("load", () =>{
            let color = localStorage.getItem('user-main-color');
            if (color) {
                document.documentElement.style.setProperty('--user-main-color', color);
            };
            //check if user comes from the cookie baner
            if (window.location.href.indexOf('cookie-frage') != -1) {
                document.getElementById('cookie-frage').open = true;

            }
        })
    </script>
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("details").forEach((detail) => {
                detail.addEventListener("toggle", function () {
                    if (this.open) {
                        document.querySelectorAll("details").forEach((otherDetail) => {
                            if (otherDetail !== this) {
                                otherDetail.open = false;
                            }
                        });
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
        <h1>FAQ</h1>
        <h2>Allgemeines</h2>
            <div class="part">
                <details>
                    <summary>Was ist diese Datenbank und welche Informationen speichert sie?</summary>
                    <p class="answer">Diese Datenbank enthält Informationen über 3D-Druck-Filamente.<br>
                        Hierzu zählen Werte wie Hersteller, Material, Preise, Farben, Temperaturen und Bilder von einem 3DBenchy und der Spule.<br>
                        Die Daten sind in erster Linie für die SuS der Prinz-von-Homburg-Schule und für das Lehrpersonal.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Welche Arten von 3D-Druck-Filamenten sind in der Datenbank enthalten?</summary>
                    <p class="answer">In der <i>Gast</i>-Ansicht der Datenbank sind nur Filamente der Prinz-von-Homburg-Schule sichtbar. Um weitere (private) Filamente sehen zu können, muss man mit seinen Benutzerdaten angemeldet sein.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Wie oft werden die Daten aktualisiert?</summary>
                    <p class="answer">Die Daten der Datenbank werden unregelmäßig überprüft und bei Veränderungen aktualisiert.<br>Bei neuem Filament wird sofort nach erfolgreichem Test die Datenbank mit dem entsprechenden Beitrag erweitert.</p>
                </details>
            </div>
        <h2>Benutzung der Datenbank</h2>
            <div class="part">
                <details>
                    <summary>Wie kann ich nach einem bestimmten Filament suchen?</summary>
                    <p class="answer">Hierfür stehen die Suchfunktion, die Tabellenausgabe und der QR-Code-Scanner zur Verfügung.<br>
                    Um Einträge zu finden, gib dein Stichwort in der Suchleiste ein oder sortiere die Ansicht auf der <a href="../index.php">Startseite</a> nach deinem gesuchten Wert.<br>
                    Wenn du die Spule vor dir hast, scanne den darauf vorhandenen QR-Code mit deinem Handy oder gib die Nummer in die Suchleiste ein.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Welche Filter stehen mir zur Verfügung?</summary>
                    <p class="answer">In der Tabellenausgabe auf der <a href="../index.php">Startseite</a> sowie auf der Seite der Suchergebnisse kann die Ausgabe nach Hersteller, Material, Preis und Gewicht sortiert werden. Für weitere Filter nutze bitte die Suchfunktion.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Kann ich eigene Filament-Daten hinzufügen?</summary>
                    <p class="answer">Nein. Dies ist nur den Administratoren der Datenbank erlaubt, um einheitliche und korrekte Daten zu gewährleisten.</p>
                </details>
            </div>
        <h2>Technische Fragen zu den Filament-Daten</h2>
            <div class="part">
                <details>
                    <summary>Welche technischen Werte werden gespeichert?</summary>
                    <p class="answer">Zu den gespeicherten technischen Werten zählen das Material, die Dicke, das Gewicht und die Drucktemperaturen der Druckplatte und der Düse.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Woher stammen die Informationen in der Datenbank?</summary>
                    <p class="answer">Alle Informationen wurden vom Entwickler und Administrator Jan in eigener Recherche erfasst und eingefügt.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Gibt es eine Möglichkeit, Filament-Empfehlungen für meinen Drucker zu erhalten?</summary>
                    <p class="answer">Das könnte ein zukünftiges Update bringen. Eine gute Antwort ist hierbei immer <a href="../pages/search.php?query=PLA">PLA</a>.</p>
                </details>
            </div>
        <h2>Datenimport & Export</h2>
            <div class="part">
                <details>
                    <summary>Kann ich die Datenbank exportieren (z. B. als CSV oder JSON)?</summary>
                    <p class="answer">Diese Funktion ist zukünftig geplant, steht jedoch momentan nicht zur Verfügung.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Gibt es eine API, um auf die Daten zuzugreifen?</summary>
                    <p class="answer">Diese Funktion ist zukünftig geplant, steht jedoch momentan nicht zur Verfügung.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Kann ich meine eigene Filament-Liste hochladen?</summary>
                    <p class="answer">Nein, diese Datenbank ist ausschließlich für Filamente der Prinz-von-Homburg-Schule.</p>
                </details>
            </div>
        <h2>Problemlösungen & Support</h2>
            <div class="part">
                <details>
                    <summary>Warum finde ich ein bestimmtes Filament nicht in der Datenbank?</summary>
                    <p class="answer">Dafür gibt es mehrere mögliche Ursachen:<br>
                        <ul>
                            <li>Das gesuchte Filament ist nicht vorhanden.</li>
                            <li>Falsche Such-Eingabe – versuche es bitte mit anderen Stichworten.</li>
                            <li>Die Datenbank ist gerade nicht erreichbar – sollte dies der Fall sein, wird sich ein Administrator dem Problem annehmen.</li>
                        </ul>
                    </p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Wie kann ich falsche oder fehlende Werte melden?</summary>
                    <p class="answer">Melde dich hierfür bei Jan Albrecht <a href="mailto:kontakt@jan-alb.de">kontakt@jan-alb.de</a>.</p>
                </details>
            </div>
            <div class="part">
                <details>
                    <summary>Gibt es eine Community oder einen Support für Fragen?</summary>
                    <p class="answer">Es gibt eine kleine, aber stetig wachsende Gemeinschaft an 3D-Druck-Begeisterten an unserer Schule.<br>
                        Ganz vorne mit dabei sind Jan Albrecht und Thorsten Henke.</p>
                </details>
            </div>
        <h2>Cookies</h2>
            <div class="part">
                <details id="cookie-frage">
                    <summary>Warum werden Cookies verwendet?</summary>
                    <p class="answer">Die verwendeten Cookies sind technisch notwendig, um die personalisierten Website-Eigenschaften zu gewährleisten.<br>
                        Zu diesen Funktionen gehören: die Benutzerfarbe, der Modus (Tag/Nacht) und der Benutzeraccount.<br>
                        <button onclick="openCookieMenu()">Alle Websitedaten löschen</button></p>
                </details>
            </div>
            <div class="alert" id="cookie-del-frage" style="display: none;">
                <h2>Alle Websitedaten löschen?</h2>
                <p>Bei Bestätigung werden alle Websitedaten unwiderruflich gelöscht.</p>
                <div class="button-container">
                    <button class="yes" onclick="localStorage.clear();document.getElementById('cookie-del-frage').style.display = 'none';document.getElementById('all-deleted').style.display = 'block';">Ja, alle Daten löschen</button>
                    <button class="no" onclick="document.getElementById('cookie-del-frage').style.display = 'none';">Nein, Daten behalten</button>
                </div>
            </div>
            <div class="alert" id="all-deleted" style="display: none;">
                <h2>Alle Websitedaten gelöscht!</h2>
                <p>Die Websitedaten wurden erfolgreich gelöscht.</p>
                <p>Nach Klicken der Schaltfläche lädt die Seite neu, um die Änderungen zu verarbeiten.</p>
                <button class="ok" onclick="location.reload();">OK</button>
            </div>
    </div>
</body>
<footer id="footer" class="center">
    <div id="footer-content">
        <!--code gets injected by header.js-->
    </div>
</footer>
</html>