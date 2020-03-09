<?php
//affichage du contenu selon les variables globales d'URL.
$action = "";

if(!isset($_GET["action"])){
    $action = "list";
}else{
    $action = $_GET["action"];
}

switch($action) {
    case "last":
        //echo "cas où last";
        showBook(getLastBook());
        break;
    case "list":
        getBookList();
        break;
    case "livre":
        if(isset($_GET["idLivre"])){
            showBook(getBook($_GET["idLivre"]));
        }
        break;
    case "authorList":
        getAuthorList();
        break;
    case "showAuteur":
        if(isset($_GET["idAuteur"])){
            //printRResult($_GET["idAuteur"]);
            showAuthor(getAuthor($_GET["idAuteur"]));
        }
        break;
    default:
        getBookList();
        break;
}
?>