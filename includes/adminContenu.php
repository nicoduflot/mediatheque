<?php
$action = "";

if(!isset($_GET["action"])){
    $action = "last";
}else{
    $action = $_GET["action"];
}

switch($action) {
    case "last":
        getMediaList("back");
        getAuthorList("back");
        getCatList("back");
        break;
    case "list":
        getMediaList("back");
        break;
    case "authorList":
        getAuthorList("back");
        break;
    case "catList":
        getCatList("back");
        break;
    case "showAuteur":
        if(isset($_GET["idAuteur"])){
            showAuthor(getAuthor($_GET["idAuteur"], "back"), "back");
        }
        break;
    case "addAuthor":
        if(isset($_POST["submitAddAuthor"])){
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $bio = $_POST["bio"];
            addAuthor($nom, $prenom, $bio);
            header("location: index.php?action=authorList");
        }else{
            showAuthor(getAuthor("null"), "back", "form");
        }
        break;
    case "editAuteur" :
        if(isset($_GET["idAuteur"])){
            if(isset($_POST["submitAddAuthor"])){
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $bio = $_POST["bio"];
                $idAuteur = $_POST["idAuteur"];
                editAuthor($idAuteur, $nom, $prenom, $bio);
                header("location: index.php?action=authorList");
            }
            showAuthor(getAuthor($_GET["idAuteur"], "back"), "back", "form");
        }
        break;
    case "deleteAuteur" :
        if(isset($_GET["idAuteur"])){
            if(isset($_POST["deleteAuthor"])){
                $idAuteur = $_GET["idAuteur"];
                deleteAuthor($idAuteur);
                header("location: index.php?action=authorList");
            }else{
                showDeleteAuthor(getAuthor($_GET["idAuteur"]));
            }
        }
        break;
    case "media":
        if(isset($_GET["idMedia"])){
            showMedia(getMedia($_GET["idMedia"], "back"), "back");
        }
        break;
    case "add":
        if(isset($_POST["submitAddBook"])){
            $titre = $_POST["titre"];
            $resume = $_POST["resume"];
            $dateNow = date('Y-m-d H:i:s');
            $idUtilisateur = $_POST["idUtilisateur"];
            addMedia($idUtilisateur, $titre, $dateNow, $resume);
            header("location: index.php?action=list");
        }else{
            showMedia(getMedia("null"), "back", "form");
        }
        break;
    case "edit":
        if(isset($_GET["idMedia"])){
            if(isset($_POST["submitAddBook"])){
                //echo "<br />Edition de média";
                $titre = $_POST["titre"];
                $resume = $_POST["resume"];
                $dateNow = date('Y-m-d H:i:s');
                $idMedia = $_POST["idMedia"];
                $idUtilisateur = $_POST["idUtilisateur"];
                editMedia($idMedia, $titre, $resume);
                header("location: index.php?action=list");
            }
            showMedia(getMedia($_GET["idMedia"]), "back", "form");
        }
        break;
    case "delete":
        if(isset($_GET["idMedia"])){
            if(isset($_POST["deleteBook"])){
                $idMedia = $_GET["idMedia"];
                deleteMedia($idMedia);
                header("location: index.php?action=list");
                //echo "Entrée effacée, <a href=\"index.php?action=list\">retour liste.</a>";
            }else{
                showDelete(getMedia($_GET["idMedia"]));
            }
        }
        break;
    case "linkAuthor":
        if(isset($_POST["submitAddLinkAuth"])){
            $idAuteur = $_POST["idAuteur"];
            $idMedia = $_POST["idMedia"];
            addLinkAthMd($idAuteur, $idMedia);
        }
        showLinkAuthorMedia("back");
        break;
    case "linkCat" :
        if(isset($_POST["submitAddLinkCat"])){
            $idCat = $_POST["idCategorie"];
            $idMedia = $_POST["idMedia"];
            addLinkCatMd($idCat, $idMedia);
        }
        showLinkCatMedia("back");
        break;
    case "addCat":
        if(isset($_POST["submitAddCat"])){
            $nom = $_POST["nom"];
            $description = $_POST["description"];
            addCat($nom, $description);
            header("location: index.php?action=list");
        }
        showCat(getCat("null"), "back", "form");
        break;
    case "editCat" :
        if(isset($_GET["idCat"])){
            if(isset($_POST["submitAddCat"])){
                $nom = $_POST["nom"];
                $description = $_POST["description"];
                $idCat = $_POST["idCat"];
                editCat($idCat, $nom, $description);
                header("location: index.php?action=catList");
            }
            showCat(getCat($_GET["idCat"], "back"), "back", "form");
        }
        break;
    case "deleteCat" :
        if(isset($_GET["idCat"])){
            if(isset($_POST["deleteCat"])){
                $idCat = $_GET["idCat"];
                deleteCat($idCat);
                header("location: index.php?action=catList");
            }else{
                showDeleteCat(getCat($_GET["idCat"]));
            }
        }
        break;
    case "showCat":
        showCat(getCat($_GET["idCat"], "back"), "back", "form");
        break;
    default:
        showMedia(getLastMedia("back"), "back");
}
?>
