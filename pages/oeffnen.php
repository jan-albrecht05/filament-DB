<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament Database</title>
</head>
<body>
    <?php
        // Open the sqlite3 database file only if it already exists
        if(file_exists("../assets/db/ff.db")){
            $db = new SQLite3("../assets/db/ff.db");

            // Query to select all data from the filament table
            $result = $db->query("SELECT * FROM filament");

            // Check if there are any rows returned
            if ($result) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Hersteller</th><th>Farbe</th><th>Material</th><th>Dicke</th><th>Price</th><th>Gewicht</th><th>Besitzer</th><th>Anzahl</th><th>Bedtemp</th><th>Nozzletemp</th><th>Additional Info</th><th>Active</th></tr>";
                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['hersteller'] . "</td>";
                    echo "<td>" . $row['farbe'] . "</td>";
                    echo "<td>" . $row['material'] . "</td>";
                    echo "<td>" . $row['dicke'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['gewicht'] . "</td>";
                    echo "<td>" . $row['besitzer'] . "</td>";
                    echo "<td>" . $row['anzahl'] . "</td>";
                    echo "<td>" . $row['bedtemp'] . "</td>";
                    echo "<td>" . $row['nozzletemp'] . "</td>";
                    echo "<td>" . $row['additionalinfo'] . "</td>";
                    echo "<td>" . ($row['active'] ? 'Yes' : 'No') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No data found in the table.";
            }
        } else {
            echo "Database does not exist";
        }
    ?>
</body>
</html>