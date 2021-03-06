<?php
//phpinfo();
//session_start();
include "./includes/connection.php";
include "functions/dbChanges.php";
include "functions/template.php";
include "functions/functions.php";
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Médiathèque</title>
        <script src="js/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/functions.js"></script>
    </head>
    <body class="container">
        <header>
            <?php include "includes/mediathequeMenu.php"; ?>
        </header>
        <section>
            <?php include "includes/mediathequeContenu.php"; ?>
        </section>
    </body>
</html>
