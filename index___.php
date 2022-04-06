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
        $dbName = getenv('DB_NAME'); 
        $dbUser = getenv('DB_USER'); 
        $dbPassword = getenv('DB_PASSWORD'); 
        $dbHost = getenv('DB_HOST'); 
        
        // Connect to mySQL database using PHP PDO Object.
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword); 

        // Tell PDO to throw Exceptions for every error.
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create the SELECT query and fetch the table rows as associative array.
        $query = $dbConnection->query("select * from Books"); // https://www.php.net/manual/de/pdo.query.php
        $query->fetch(PDO::FETCH_ASSOC); // https://www.php.net/manual/de/pdostatement.fetch.php

        // Print HTML table with Books data.
        echo '<div class="container-fluid p-5">';

            echo '<div class="h3">My favourite Books</div>';
            echo '<table class="table table-striped">';
        
                // Print table header.
                $columnCount = $query->columnCount(); // https://www.php.net/manual/de/pdostatement.columncount.php
                echo "<thead>";
                    echo "<tr>";

                        for ($counter = 0; $counter < $columnCount; $counter ++) {
                            $columnInfo = $query->getColumnMeta($counter); // https://www.php.net/manual/de/pdostatement.getcolumnmeta.php
                            $columnName = $columnInfo['name'];
                            echo "<th>$columnName</th>"; 
                        }
                        
                    echo '</tr>';    
                echo "</thead>";
                // End of table header.

                // Print table rows.          
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";

                    foreach ($row as $columnName => $value) {
                        echo "<td>$value</td>";
                    }

                    echo '</tr>';                    ;
                }
                // End of table rows.               

            echo '</table>';        
        echo '</div>'; 

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