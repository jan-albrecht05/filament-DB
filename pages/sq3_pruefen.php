<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(extension_loaded("sqlite3")){
            echo "SQLite3 is installed<br>";
            $version = SQLite3::version();
            echo "Version er SQlite-Bibiolthek: ".$version['versionString'];
        } else {
            echo "SQLite3 is not installed";
        }
    ?>
</body>
</html>