# Filament-DB – 3D-Druck Filamentverwaltung

[![MIT License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)<br>
![Made with PHP](https://img.shields.io/badge/PHP-8.x-blue)
![SQLite](https://img.shields.io/badge/Database-SQLite-lightgrey)
![CSS](https://img.shields.io/badge/Style-CSS-blueviolet)
![JavaScript](https://img.shields.io/badge/Frontend-JavaScript-yellow)
![CSS](https://img.shields.io/badge/Frontend-HTML-orange)

> Ein webbasiertes Tool zur Organisation und Verwaltung Schulinterner und privater 3D-Druck-Filamente mit Benutzerkonten, personalisierter UI und Rechtesystem.

---

## 🔗 Jetzt live!
[hier klicken](https://filament-db.free.nf/)
<br><br>
---

## 🚀 Features

- 🧵 **Filament-Verwaltung**
  - Hersteller, Material, Farbe, Gewicht, Preis u. v. m.
  - Übersichtliche Datenbankansicht mit Sortierung und Suche
  - QR-Code-Scanner für QR-Codes auf Spulen

- 👥 **Benutzerkonten & Rollen**
  - Unterschiedliche Rechtelevel
  - Benutzerbasiertes Layout und Funktionsumfang
  - ohne Anmeldung nutzbar!
    > dann aber nur schulische Filamente

- 🎨 **UI/UX-Personalisierung**
  - Dark- und Lightmode
  - Auswahl individueller Akzentfarbe
  - Speicherung im LocalStorage

- 🔐 **Rechteverwaltung**
  - Unterschiedliche Benutzerrollen und Zugriffskontrollen

- 🗄️ **Leichtgewichtige Architektur**
  - PHP + SQLite-Backend
  - HTML/CSS/JavaScript-Frontend

---

## 🛠️ Verwendete Technologien

| Technologie | Zweck                                           |
|-------------|-------------------------------------------------|
| **HTML**    | Struktur und Semantik der Seiten                |
| **CSS**     | Styling, Layout, Dark-/Lightmode, Akzentfarben  |
| **JavaScript** | UI-Interaktivität, Speicherung im LocalStorage |
| **PHP**     | Serverlogik, Authentifizierung, Datenbankzugriff |
| **SQLite**  | Persistente Speicherung aller Daten             |

---

## 🗄️ Datenbanken

### Die Filament-SQLite-Datenbank enthält:

  - ID
  - Hersteller
  - Preis
  - Material
  - Durchmesser
  - Farbe
  - ursprüngliches Gewicht
  - Besitzer
  - Anzahl der verfügbaren Rollen
  - Temperatur der Düse
  - Temperatur des Druckbetts
  - Bild vom 3D-Benchy
  - Bild von der Spule
  - Standort der Spule
  - Zusätzliche Infos/Tags für die Suche
  - Status (Neu/Nutzbar/verbraucht)

### Die Benutzer-SQLite-Datenbank enthält:

  - Benutzername
  - Passwort
  - Rolle
  - Profilbild

---

## 📷 Handling der Bilder

Bilder werden in den Ordner ```/assets/img/uploads/``` hochgeladen und der Link in der Datenbank gespeichert.

---

## ⏭️ next Steps
  - UI Personalisierung in Benutzer-Datenbank einfügen (Mode, Farbe)

---

## 🤝 Contribution
### Pull Requests und Vorschläge sind willkommen!
### Bei Problemen, Fehlern oder Anregungen gern ein Issue eröffnen!

---

## ✨ Autor
Jan Albrecht 
[GitHub](https://github.com/jan-albrecht05)
