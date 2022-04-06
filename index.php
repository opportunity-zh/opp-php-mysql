<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <h3>Hello, we are starting to work with Databases and PHP PDO!</h3>

    <?php
        // Prepare connection parameters.
        // getenv(string $varname, bool $local_only = false): string|false
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        
        // Connect to mySQL database using PHP PDO Object.
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
        
        // Tell PDO to throw Exceptions for every error.
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create the SELECT query and fetch all table rows as associative array.
        // https://www.php.net/manual/de/pdo.query.php

        // $query = $dbConnection->query("SELECT * from Books");
        // $query = $dbConnection->query("SELECT Autor, Title FROM  Books");
        // $query = $dbConnection->query("SELECT * FROM Books WHERE ID=4");
        // $query = $dbConnection->query("SELECT * FROM Books WHERE Title LIKE '%s4%'");
        // $query = $dbConnection->query("SELECT * FROM Books WHERE Category='HTML'");

        // $query = $dbConnection->query("SELECT Autor, Title, Year FROM Books WHERE Year>2000");
        // $query = $dbConnection->query("SELECT Autor, Title, Year FROM Books WHERE Year>2000 ORDER BY Year");
        $query = $dbConnection->query("SELECT Autor, Title, Year FROM Books WHERE Year>2000 ORDER BY Year LIMIT 4");

        echo '<div class="container-fluid p-5">';
        echo '<div class="h3">My favourite Books</div>';
        echo '<table class="table table-striped">';

            // Print table header.
            echo '<thead>';
            echo '<tr>';

            // Get column metadata and the name of the column.
            $columnCount = $query->columnCount();

            for ($i = 0; $i < $columnCount; $i++) {
                $columnInfo = $query->getColumnMeta($i);
                $columnName = $columnInfo['name'];
                echo "<td>$columnName</td>";
            }

            echo '</tr>';    
            echo '</thead>';

            // Print table rows (for each book one row).
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';

                // For each column (<td>) one value.
                foreach ($row as $columnName => $value) {
                    echo "<td>$value</td>";
                }
    
                echo '</tr>';
            }
            // End of table rows. 

        echo '</table>';
        echo '</div>';
        echo '</div>';

        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';

        /*
            More ideas: 
            - SELECT all books, Author and Title only

            - SELECT books by category
            - SELECT books newer than YYYY
            - SELECT books by keyword (title)

            - SELECT book by id
            - SELECT first book by category

            - INSERT INTO Books (using form, input fields, action: same page)
                    https://www.phptutorial.net/php-pdo/php-pdo-insert/
        */

    ?>
    
</body>
</html>