<?php
function openConn(){
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $db = "formationphp";

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $db)
        or die("La connexion à échoué : %s\n".$conn -> error);

    return $conn;
}

function closeConn($conn){
    mysqli_close($conn);
}
?>