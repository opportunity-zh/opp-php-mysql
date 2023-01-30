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

    <form action="index.php" method="post">
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

                        echo "<tr>";
                        echo "<td style='width: 300px;'>$translatedColumnName</td>";

                        /*
                            genre:          dropdown (<select><option>)
                            description:    type "textarea"
                            currency:       type "radio"
                            out_of_print:   type "checkbox"
                        */
                        switch ($columnName) {
                            case "genre":
                                echo "<td>
                                    <select id='genre' name='genre'>
                                        <option value='horror'>Horror</option>
                                        <option value='biography'>Biography</option>
                                        <option value='adventure'>Adventure</option>
                                    </select>
                                </td>";
                                break;

                            case "description":
                                echo "<td><textarea name='description' rows='10' cols='30'>$value</textarea></td>";
                                break;

                            case "currency":
                                echo "<td>
                                    <input type='radio' id='currency_chf' name='currency' value='$value'>
                                    <label for='currency_chf'>CHF</label><br>
                                    <input type='radio' id='currency_usd' name='currency' value='$value'>
                                    <label for='currency_usd'>USD</label><br>
                                </td>";
                                break;     

                            case "out_of_print":
                                echo "<td> 
                                    <input type='checkbox' id='sold-out' name='sold-out' value='$value'>
                                    <label for='sold-out'>Available</label><br>
                                    <input type='checkbox' id='sold-out' name='sold-out' value='$value'>
                                    <label for='sold-out'>Sold Out</label><br>
                                </td>";
                                break;

                            default:
                                echo "<td><input type='text' name='$columnName' value='$value'></td>";
                        }

                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table> 

        <input class="btn btn-primary" type="submit" value="Speichern">  
        <button type="button" class="btn btn-info"
            onclick="document.location='index.php';">Zurück</button>
    </form>                
           
</body>
</html>