<?php
$action = "";

if(!isset($_GET["action"])){
    $action = "list";
}else{
    $action = $_GET["action"];
}

switch($action) {
    case "last":
        //echo "cas où last";
        showBook(getLastBook(), "back");
        break;
    case "list":
        getBookList("back");
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
            dbChangeQuery($link, $sql, "livre");
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
    case "livre":
        if(isset($_GET["idLivre"])){
            showBook(getBook($_GET["idLivre"], "back"), "back");
        }
        break;
    case "add":
        if(isset($_POST["submitAddBook"])){
            $titre = $_POST["titre"];
            $resume = $_POST["resume"];
            $dateNow = date('Y-m-d H:i:s');
            $idUtilisateur = $_POST["idUtilisateur"];
            $link = openConn();
            $sql = "INSERT INTO `livre` 
                    (`utilisateur_id`, 
                    `titre`, 
                    `date`, 
                    `resume` ) VALUES 
                    (".$idUtilisateur.", 
                    '".addslashes(utf8_decode($titre))."', 
                    '".$dateNow."',
                    '".addslashes(utf8_decode($resume))."');";
            dbChangeQuery($link, $sql, "livre");
            closeConn($link);
            header("location: index.php?action=list");
        }else{
            showBook(getBook("null"), "back", "form");
        }
        break;
    case "edit":
        if(isset($_GET["idLivre"])){
            if(isset($_POST["submitAddBook"])){
                //echo "<br />Edition de livre";
                $titre = $_POST["titre"];
                $resume = $_POST["resume"];
                $dateNow = date('Y-m-d H:i:s');
                $idLivre = $_POST["idLivre"];
                $idUtilisateur = $_POST["idUtilisateur"];
                $link = openConn();
                $sql = "UPDATE 
                            `livre` 
                        SET `titre` = '".addslashes(utf8_decode($titre))."', 
                            `resume` = '".addslashes(utf8_decode($resume))."'                         
                        WHERE `livre`.`id` = ".$idLivre.";";
                dbChangeQuery($link, $sql, "livre");
                closeConn($link);
                header("location: index.php?action=list");
            }
            showBook(getBook($_GET["idLivre"]), "back", "form");
        }
        break;
    case "delete":
        if(isset($_GET["idLivre"])){
            if(isset($_POST["deleteBook"])){
                $sql = "DELETE FROM `livre` WHERE `livre`.`id` = ".$_GET["idLivre"].";";
                $link = openConn();
                dbChangeQuery($link, $sql, "livre");
                closeConn($link);
                header("location: index.php?action=list");
                //echo "Entrée effacée, <a href=\"index.php?action=list\">retour liste.</a>";
            }else{
                showDelete(getBook($_GET["idLivre"]));
            }
        }
        break;
    case "linkAuthor":
        if(isset($_POST["submitAddLink"])){
            $idAuteur = $_POST["idAuteur"];
            $idLivre = $_POST["idLivre"];
            $link = openConn();

            $sql = "SELECT 
	            * 
            FROM 
	            `auteur_livre` `l` 
	        WHERE 
	            `idauteur` = ".$idAuteur." 
	            AND `idlivre` = ".$idLivre.";";
            $result = mysqli_query($link, $sql);
            $nbRows = mysqli_num_rows($result);

            if($nbRows == 0 && $idAuteur !=0 && $idLivre != 0) {
                $sql = "INSERT INTO `auteur_livre` 
                        (`idauteur`, 
                        `idlivre`) VALUES 
                        (" . $idAuteur . ", 
                        " . $idLivre . ");";
                dbChangeQuery($link, $sql, "livre");

                header("location: index.php?action=list");
            }
            else{
                if($nbRows != 0){
                    echo "Ce lien existe déjà";
                }elseif ($idLivre == 0 && $idAuteur == 0){
                    echo "Vous devez choisir un auteur ET un livre";
                }elseif($idLivre == 0){
                    echo "Vous devez choisir un livre";
                }else{
                    echo "Vous devez choisir un auteur";
                }

            }
            closeConn($link);
        }
        showLinkAuthorBook("back");
        break;
    default:
        showBook(getLastBook(), "back");
}
?>