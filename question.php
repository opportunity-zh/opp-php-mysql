<?php
    include 'php/data-collector.php';
    include 'php/db.php';

    // Evaluate data in $_POST variable.
    $currentQuestionIndex = 0;

    if (isset($_POST['lastQuestionIndex'])) {
        // Get data from last post.
        $lastQuestionIndex = $_POST['lastQuestionIndex'];

        if (isset($_POST['nextQuestionIndex'])) {
            // Define the index number of the next question.
            $currentQuestionIndex = $_POST['nextQuestionIndex'];
        }
    }

    // Check if $_SESSION['questions'] exists.
    if (isset($_SESSION['questions'])) {
        // echo 'questions data EXISTS in session.<br>';
        $questions = $_SESSION['questions'];
    }
    else {
        // echo 'questions data does NOT exist in session.<br>';

        // Get questions data from database using php/db.php ...
        $questions = getQuestions();

        // ... and save that data in $_SESSION. 
        $_SESSION['questions'] = $questions;
    }

    // echo '<pre>';
    // print_r($_SESSION['questions']);
    // echo '</pre>';

    // TODO: Handle transition from last question to result page.
    // TODO: Use JS validation (checkboxes, radio) with warning <p>.
    // TODO: Image from folder or from database.
    // TODO: Back button mit JS.

    include 'php/header.php';
?>

<h3>Frage <?php echo $currentQuestionIndex; ?></h3>
<p><?php echo $questions[$currentQuestionIndex]['text']; ?></p>

<form <?php if ($currentQuestionIndex + 1 >= count($questions)) echo 'action="result.php" '; ?>method="post">
    <?php
        $answers = $questions[$currentQuestionIndex]['answers'];
        $isMultipleChoice = $questions[$currentQuestionIndex]['isMultipleChoice'];
        $maxPoints = 0;

        for ($a = 0; $a < count($answers); $a++) {
            echo '<div class="form-check">';
            $isCorrect = $answers[$a]['isCorrect'];

            if ($isMultipleChoice == 1) {
                // Multiple Choice (checkbox)
                echo '<input class="form-check-input" type="checkbox" name="a-' . $a . '" value="' . $isCorrect . '" id="i-' . $a . '">';
            }
            else {
                // Single Choice (radio)
                echo '<input class="form-check-input" type="radio" name="a-0" value="' . $isCorrect . '" id="i-' . $a . '">';
            }

            $maxPoints += $isCorrect; // same as: $maxPoints = $maxPoints + $isCorrect;

            echo '<label class="form-check-label" for="i-' . $a . '">';
            echo $answers[$a]['answer'];
            echo '</label>';
            echo '</div>';
        }
    ?>

    <!-- Hidden Fields -->
    <input type="hidden" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
    <input type="hidden" name="nextQuestionIndex" value="<?php echo $currentQuestionIndex + 1; ?>">
    <input type="hidden" name="maxPoints" value="<?php echo $maxPoints; ?>">
    <!-- END Hidden Fields -->

    <p class="warning"></p>
    <input type="submit">
</form>

<?php include 'php/footer.php'; ?>