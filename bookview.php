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
    <?php
        require "./includes/db.php";

        // $_GET liefert die 'id' aus der URL 'bookview.php?id=$id'
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        else {
            // id fehlt: Abbrechen und PHP verlassen
            exit("Achtung: Der Identifikator 'id' fehlt in der URL.");
        }

        // echo "id = $id<br>";

        // SQL-Statment formulieren: Alle Daten (ganze Tabellenzeile) 
        // zum Buch mit der erhaltenen $id
        $sqlStatement = $dbConnection->query("SELECT `title`, `genre`, `author`, `description`, `publisher`, `ISBN`, `price`, `currency`, `out_of_print` FROM `books` WHERE `id` = $id");
        $row = $sqlStatement->fetch(PDO::FETCH_ASSOC);
    ?> 

    <table class="table">
        <thead>
            <tr class="table-dark">
                <th scope="col">ISNBN <?php echo $row['ISBN']; ?></th>
                <th scope="col"><?php echo $row['title']; ?> / <?php echo $row['author']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Generiere die Tabelle: linke Spalte für Beschriftung / rechte Spalte für die Werte
                foreach ($row as $columnName => $value) {
                    $translatedColumnName = translateColumnName($columnName);

                    echo "<tr>
                        <td style='width: 300px;'>$translatedColumnName</td>
                        <td>$value</td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>   

    <button type="button" class="btn btn-info"
            onclick="document.location='index.php';">Zurück</button> 
            
</body>
</html>