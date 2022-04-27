<?php
session_start();

if (isset($_POST['lastQuestionIndex'])) {
    // Get the index (string) of the last question.
    $lastQuestionIndex = $_POST['lastQuestionIndex']; // ohne intval()

    // And create the key for that question.
    $questionKey = 'q-' . $lastQuestionIndex;

    // ACHIEVED POINTS ----------------------------------------------------------------------------

    /* 
        Get the number of achieved points, checking all keys in $_POST for
        the head 'a-', like 'a-0', 'a-1' etc.
    */
    $achievedPoints = 0;

    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'a-')) {
            // same as: $achievedPoints = $achievedPoints + intval($value);
            $achievedPoints += intval($value);
        }
    }

    // DEVONLY: echo "achievedPoints = $achievedPoints<br>";

    // Make sure the list of all achieved points exists in the $_SESSION.
    if (!isset($_SESSION['achievedPointsList'])) {
        $_SESSION['achievedPointsList'] = array();
    }
    
    /*
        Put the achieved points into the list, using a 'q-' headed key, 
        which identifies the question in the list.
    */
    $_SESSION['achievedPointsList'][$questionKey] = $achievedPoints;

    // MAX POINTS ------------------------------------------------------------------------------
    $maxPoints = intval($_POST['maxPoints']);

    // Make sure the list of all max points exists in the $_SESSION.
    if (!isset($_SESSION['maxPointsList'])) {
        $_SESSION['maxPointsList'] = array();
    }

    /*
        Put the achieved points into the list, using a 'q-' headed key, 
        which identifies the question in the list.
    */
    $_SESSION['maxPointsList'][$questionKey] = $maxPoints;
}

/* DEVONLY
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
// END DEVONLY */
?>