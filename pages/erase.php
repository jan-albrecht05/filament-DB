<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erase Database Data</title>
</head>
<body>
    <?php
    try {
        // Database connection
        $conn = new PDO('sqlite:../assets/db/ff.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL statement to delete all data from the filament table
        $sql = "DELETE FROM filament";

        // Execute the SQL statement
        $conn->exec($sql);

        echo "All data has been erased from the database.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
    ?>
</body>
</html>