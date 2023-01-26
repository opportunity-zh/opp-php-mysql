<?php
// Verbinde mit mySQL, mit Hilfe eines PHP PDO Object
$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

// Setze den Fehlermodus für Web Devs
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Feldnamen übersetzen
define(
    "NAME_MAP",
    array(
        // Schlüssel: Feldnamen => Wert: Deutsche Übersetzung
        "title" => "Titel",
        "genre" => "Genre",
        "author" => "Autor",
        "description" => "Beschreibung",
        "publisher" => "Publisher",
        "ISBN" => "ISBN",
        "price" => "Preis",
        "currency" => "Währung",
        "out_of_print" => "vergriffen"
    )
);

function translateColumnName($columnName) {
    return NAME_MAP[$columnName];
}

// ucfirst()

?>