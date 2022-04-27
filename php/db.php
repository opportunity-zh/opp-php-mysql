<?php

function getQuestions() {
    // Prepare connection parameters.
    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    // Connect to mySQL database using PHP PDO Object.
    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

    // Tell PDO to throw Exceptions for every error.
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all question and answers - together.
    $query = $dbConnection->query("SELECT * FROM Questions");
    $questions = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($q = 0; $q < count($questions); $q++) {
        $question = $questions[$q];
        $subQuery = $dbConnection->prepare("SELECT * from Answers where Answers.questionID = ?");
        $subQuery->bindValue(1, $question['id']);
        $subQuery->execute(); 
        $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);

        $questions[$q]['answers'] = $answers;
    }

    return $questions;
}

?>