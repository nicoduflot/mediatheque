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
        break;
    case "list":
        getMediaList("back");
        break;
    case "authorList":
        getAuthorList("back");
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
            $link = openConn();
            $sql = "INSERT INTO `auteur` 
                    (`nom`, 
                    `prenom`, 
                    `bio` ) VALUES 
                    ('".addslashes(utf8_decode($nom))."', 
                    '".addslashes(utf8_decode($prenom))."',
                    '".addslashes(utf8_decode($bio))."');";
            dbChangeQuery($link, $sql, "media");
            closeConn($link);
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
                $link = openConn();
                $sql = "UPDATE 
                            `auteur` 
                        SET `nom` = '".addslashes(utf8_decode($nom))."', 
                            `prenom` = '".addslashes(utf8_decode($prenom))."',                         
                            `bio` = '".addslashes(utf8_decode($bio))."'                         
                        WHERE `auteur`.`id` = ".$idAuteur.";";
                dbChangeQuery($link, $sql, "auteur");
                closeConn($link);
                header("location: index.php?action=authorList");
            }
            showAuthor(getAuthor($_GET["idAuteur"], "back"), "back", "form");
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
            $link = openConn();
            $sql = "INSERT INTO `media` 
                    (`utilisateur_id`, 
                    `titre`, 
                    `date`, 
                    `resume` ) VALUES 
                    (".$idUtilisateur.", 
                    '".addslashes(utf8_decode($titre))."', 
                    '".$dateNow."',
                    '".addslashes(utf8_decode($resume))."');";
            dbChangeQuery($link, $sql, "media");
            closeConn($link);
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
                $link = openConn();
                $sql = "UPDATE 
                            `media` 
                        SET `titre` = '".addslashes(utf8_decode($titre))."', 
                            `resume` = '".addslashes(utf8_decode($resume))."'                         
                        WHERE `media`.`id` = ".$idMedia.";";
                dbChangeQuery($link, $sql, "media");
                closeConn($link);
                header("location: index.php?action=list");
            }
            showMedia(getMedia($_GET["idMedia"]), "back", "form");
        }
        break;
    case "delete":
        if(isset($_GET["idMedia"])){
            if(isset($_POST["deleteBook"])){
                //il faut supprimer en cascade les liens auteur_media existants
                $sqlKillLinks = "DELETE FROM `auteur_media` `a_l` WHERE `a_l`.`idmedia` = ".$_GET["idMedia"].";";
                $sql = "DELETE FROM `media` WHERE `media`.`id` = ".$_GET["idMedia"].";";
                $link = openConn();
                dbChangeQuery($link, $sqlKillLinks, "auteur_media");
                dbChangeQuery($link, $sql, "media");
                closeConn($link);
                header("location: index.php?action=list");
                //echo "Entrée effacée, <a href=\"index.php?action=list\">retour liste.</a>";
            }else{
                showDelete(getMedia($_GET["idMedia"]));
            }
        }
        break;
    case "deleteAuteur" :
        if(isset($_GET["idAuteur"])){
            if(isset($_POST["deleteAuthor"])){
                //il faut supprimer en cascade les liens auteur_media existants
                $sqlKillLinks = "DELETE FROM `auteur_media` `a_l` WHERE `a_l`.`idauteur` = ".$_GET["idAuteur"].";";
                $sql = "DELETE FROM `auteur` WHERE `auteur`.`id` = ".$_GET["idAuteur"].";";
                $link = openConn();
                dbChangeQuery($link, $sqlKillLinks, "auteur_media");
                dbChangeQuery($link, $sql, "auteur");
                closeConn($link);
                header("location: index.php?action=authorList");
            }else{
                showDeleteAuthor(getAuthor($_GET["idAuteur"]));
            }
        }
        break;
    case "linkAuthor":
        if(isset($_POST["submitAddLink"])){
            $idAuteur = $_POST["idAuteur"];
            $idMedia = $_POST["idMedia"];
            $link = openConn();

            $sql = "SELECT 
	            * 
            FROM 
	            `auteur_media` `l` 
	        WHERE 
	            `idauteur` = ".$idAuteur." 
	            AND `idMedia` = ".$idMedia.";";
            $result = mysqli_query($link, $sql);
            $nbRows = mysqli_num_rows($result);

            if($nbRows == 0 && $idAuteur !=0 && $idMedia != 0) {
                $sql = "INSERT INTO `auteur_media` 
                        (`idauteur`, 
                        `idmedia`) VALUES 
                        (" . $idAuteur . ", 
                        " . $idMedia . ");";
                dbChangeQuery($link, $sql, "media");

                header("location: index.php?action=list");
            }
            else{
                if($nbRows != 0){
                    echo "Ce lien existe déjà";
                }elseif ($idMedia == 0 && $idAuteur == 0){
                    echo "Vous devez choisir un auteur ET un Media";
                }elseif($idMedia == 0){
                    echo "Vous devez choisir un media";
                }else{
                    echo "Vous devez choisir un auteur";
                }

            }
            closeConn($link);
        }
        showLinkAuthorMedia("back");
        break;
    default:
        showMedia(getLastMedia(), "back");
}
?>
