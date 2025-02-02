# filament-DB
## for all of our 3D-printing-filament
# Feel free to contribute!
<img src="/assets/img/overview.png" alt="">
If you're a better programmer with PHP than I am, (a total noob) please help me with this project!

## To-Do:
- [ ] Homepage:
    - [x] Text-input
    - [x] Heading.js
    - [x] different modes (Table-/Grid-View)
    - [x] "Hinzufügen"-Button
    - [ ] Sort by: Farbe, Material, Dicke (Header mit Buttons)
    - [ ] last used filemants anzeigen/vorschlagen
    - [ ] Links to filament page
    - [ ] QR-Scanner
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
- [x] Search Page "?query="
   - [ ] connecting to DB
- [ ] Filament-page:
    - Anzeige der DB-Daten
    - PpG (Preis pro Gramm) berechnen
- [ ] zweite Datenbank mit Nutzerdaten
    - Username
    - Password
    - Profile_Picture
    - pref_Color
- [x] costom color toggle
- [ ] Dark-/Light-Mode toggle
- [x] Footer:
    - [ ] FAQ.html
    - [x] Impressum.html
    - [x] GitHub Link
- [ ] QR-Codes / Nummern für Spulen
- [ ] Bilder der Benchys
- [ ] hinzufügen der einzelnen Filamente

## Logic
### Header:
- [ ] ohne Anmeldung: standard
- [ ] mit Anmeldung: Profilbild + Vorname

### index.php:
- [ ] mit Anmeldung: Anzeige aller Daten
- [ ] ohne Anmeldung: Anzeige aller [public]-Daten, normale Sortierung nach ID
- [ ] Andere Sortierung nach Hersteller, Material, Farbe, Durchmesser, Preis, Gewicht, Besitzer, Anzahl (aufsteigend, absteigend)

### Suche.php:
- [ ] Suche in DB nach eingegebener value
- [ ] ohne Anmeldung: nur [public]-Daten
- [ ] mit Anmeldung: alle Daten
- [ ] Sortierungsmöglichkeiten wie in index.php

### Anzeige in Liste/Grid:
- [ ] bei Click auf Item => get _id_ => a href="/pages/filament.php?view=_id_"

## filament.php
- [ ] Abfrage nach token nach "?view=" aus DB
- [ ] bei [private]-Daten nur mit Anmeldung => Weiterleitung zur Anmeldung und zurück

### Klick auf Hinzufügen ohne Anmeldung:
- [ ] Weiterleitung zur Anmeldeseite, dann zu pages/add.php

### Account
- Profilbild
- Name, Vorname

## Hosting:
Apache Webserver?