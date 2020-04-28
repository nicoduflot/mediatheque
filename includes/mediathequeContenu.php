<?php
//affichage du contenu selon les variables globales d'URL.
$action = "";

if(!isset($_GET["action"])){
    $action = "index";
}else{
    $action = $_GET["action"];
}

switch($action) {
    case "index":
        //echo "cas où last";
        //showBook(getLastBook());
        getMediaList();
        getAuthorList();
        break;
    case "list":
        getMediaList();
        break;
    case "media":
        if(isset($_GET["idMedia"])){
            showMedia(getMedia($_GET["idMedia"]));
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
        getMediaList();
        getAuthorList();
        break;
}
?>
