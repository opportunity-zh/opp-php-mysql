<?php
    // TODO: Move DB code into function.
    // TODO: Call DB code only once, depending on $_SESSION.
    // TODO: Single Choice, multiple choice (radio vs checkbox).
    // TODO: Use JS validation (checkboxes, radio) with warning <p>.
    // TODO: Handle transition from last question to result page.
    // TODO: Back button mit JS.
    $currentQuestionIndex = 0;

    if (isset($_POST['lastQuestionIndex'])) {
        // Get data from last post.
        $lastQuestionIndex = $_POST['lastQuestionIndex'];

        if (isset($_POST['nextQuestionIndex'])) {
            // Define the index number of the next question.
            $currentQuestionIndex = $_POST['nextQuestionIndex'];
        }
    }

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

    // And put quesiton and answers data into PHP session.
    $_SESSION['quizData'] = $questions;

    echo '<pre>';
    print_r($_SESSION['quizData']);
    echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz++</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>

    <div class="container-fluid p-5 bg-primary text-white text-center quiz-header">
    <h1>QUIZZ++</h1>
    <p>From database into the quizz!</p> 
    </div>
    
    <div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
        <h3>Frage <?php echo $currentQuestionIndex; ?></h3>
        <p><?php echo $questions[$currentQuestionIndex]['text']; ?></p>
            <form method="post">

                <?php
                    $answers = $questions[$currentQuestionIndex]['answers'];

                    for ($a = 0; $a < count($answers); $a++) {
                        echo '<div class="form-check">';

                        $isCorrect = $answers[$a]['isCorrect'];
                        echo '<input class="form-check-input" type="checkbox" value="' . $isCorrect . '" id="flexCheckDefault">';
                        echo '<label class="form-check-label" for="flexCheckDefault">';

                        $answers = $questions[$currentQuestionIndex]['answers'];
                        echo $answers[$a]['answer'];

                        echo '</label>';
                        echo '</div>';
                    }
                ?>

                <!-- Hidden Fields -->
                <input type="hidden" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
                <input type="hidden" name="nextQuestionIndex" value="<?php echo $currentQuestionIndex + 1; ?>">
                <!-- END Hidden Fields -->

                <p class="warning"></p>
                <input type="submit">
            </form>
        </div>
    </div>
    </div>

</body>
</html>