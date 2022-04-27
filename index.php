<?php
    session_start();
    session_destroy();

    include 'php/header.php';
?>

<h3>Hello, we are starting to work with Databases and PHP PDO!</h3>

<form action="question.php" method="post">
    <input type="submit" value="Start">
    <p class="warning"></p>
</form>

<?php include 'php/footer.php'; ?>