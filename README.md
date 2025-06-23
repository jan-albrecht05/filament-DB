# filament-DB
## for all of our 3D-printing-filament
# Feel free to contribute!
<img src="/assets/img/overview.png" alt="">
If you're a better programmer with PHP than I am, (a total noob) please help me with this project!

## To-Do:
- [x] Homepage:
    - [x] Text-input
    - [x] Heading.js
    - [x] different modes (Table-/Grid-View)
    - [x] "Hinzufügen"-Button
    - [x] Sort by: Farbe, Material, Dicke (Header mit Buttons)
    - [x] Button ergänzen
    - [x] Links to filament page
    - [x] QR-Scanner
- [x] Datenbank aus:
    - Nummer
    - Hersteller
    - Material
    - Farbe
    - Dicke
    - Owner
    - Gewicht
    - Anzahl Spulen
    - Preis pro Spule
    - Bild vom Benchy
    - Hotend temp.
    - Printbed temp.
    - Additional Info
    - active: true/false
- [x] Page for adding content
    - [x] CSS for Input-Fields needs a bit more work
    - [x] Image upload and -handling
- [x] Search Page "?query="
   - [ ] connecting to DB
- [x] Filament-page:
    - Anzeige der DB-Daten
    - PpG (Preis pro Gramm) berechnen
- [ ] zweite Datenbank mit Nutzerdaten
    - Username
    - Password
    - Rolle (admin, user)
    - Profile_Picture
    - pref_Color
    - theme
- [x] costom color toggle
- [x] Dark-/Light-Mode toggle
- [x] Footer:
    - [x] FAQ.html
    - [x] Impressum.html
    - [x] GitHub Link
- [x] QR-Codes / Nummern für Spulen
- [x] Bilder der Benchys
- [ ] hinzufügen der einzelnen Filamente

## Logic
### Header:
- [ ] ohne Anmeldung: standard
- [ ] mit Anmeldung: Profilbild + Name

### index.php:
- [ ] mit Anmeldung: Anzeige aller Daten
- [ ] ohne Anmeldung: Anzeige aller [public]-Daten, normale Sortierung nach ID
- [x] Andere Sortierung nach Hersteller, Material, Farbe, Durchmesser, Preis, Gewicht, Besitzer, Anzahl (aufsteigend, absteigend)

### Suche.php:
- [ ] Suche in DB nach eingegebener value
- [ ] ohne Anmeldung: nur [public]-Daten
- [ ] mit Anmeldung: alle Daten
- [ ] Sortierungsmöglichkeiten wie in index.php

### add.php
- [ ] check for login-session
    if (!session) -> login.html?redirect=add.php
- [ ] Weiterleitung bei positivem Hinzufügen
- [ ] Fehlermeldungen abfangen
- [ ] Dateiformat + Größen checken

### login.html
- [ ] login mit Benutzerdaten möglich machen
- [ ] ?redirect= auslesen und nach login weiterleiten

### Security
- [ ] Nutzerdaten (PW!) verschlüsseln 

### Anzeige in Liste/Grid:
- [x] bei Click auf Item => get _id_ => a href="/pages/filament.php?view=_id_"

### filament.php
- [x] Abfrage nach token nach "?view=" aus DB
- [ ] bei [private]-Daten nur mit Anmeldung => Weiterleitung zur Anmeldung und zurück
- [ ] buttons "bearbeiten" und "deaktivieren" nur als admin

### Account
- Profilbild
- Name, Vorname
- Rolle
- "meine Filamente"

## Hosting:
Apache Webserver?
infinityfree.com?