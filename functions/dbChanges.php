<?php
//fonction d'éxécution d'une requête sql

function dbChangeQuery($link, $sql, $table){
    if(mysqli_query($link, $sql)){
        echo "La table `".$table."` a bien été modifiée<br />";
    }else{
        echo "erreur : ". utf8_decode($sql) ."<br />". mysqli_error($link);
    }
}

//ajout sql d'un auteur

function addAuthor($nom, $prenom, $bio){
    $link = openConn();
    $sql = "INSERT INTO `auteur` 
                    (`nom`, 
                    `prenom`, 
                    `bio` ) VALUES 
                    ('".addslashes(utf8_decode($nom))."', 
                    '".addslashes(utf8_decode($prenom))."',
                    '".addslashes(utf8_decode($bio))."');";
    dbChangeQuery($link, $sql, "auteur");
    closeConn($link);
}

//édition sql d'un auteur

function editAuthor($idAuteur, $nom, $prenom, $bio){
    $link = openConn();
    $sql = "UPDATE 
                `auteur` 
            SET `nom` = '".addslashes(utf8_decode($nom))."', 
                `prenom` = '".addslashes(utf8_decode($prenom))."',                         
                `bio` = '".addslashes(utf8_decode($bio))."'                         
            WHERE `auteur`.`id` = ".$idAuteur.";";
    dbChangeQuery($link, $sql, "auteur");
    closeConn($link);
}

//suppression sql d'un auteur et des lien qu'il peut avoir avec des média

function deleteAuthor($idAuteur){
    //il faut supprimer en cascade les liens auteur_media existants
    $sqlKillLinks = "DELETE FROM `auteur_media` `a_l` WHERE `a_l`.`idauteur` = ".$idAuteur.";";
    $sql = "DELETE FROM `auteur` WHERE `auteur`.`id` = ".$idAuteur.";";
    $link = openConn();
    dbChangeQuery($link, $sqlKillLinks, "auteur_media");
    dbChangeQuery($link, $sql, "auteur");
    closeConn($link);
}

//ajout sql d'une catégorie

function addCat($nom, $description){
    $link = openConn();
    $sql = "INSERT INTO `categorie` 
                    (`nom`, 
                    `description`) VALUES 
                    ('".addslashes(utf8_decode($nom))."', 
                    '".addslashes(utf8_decode($description))."');";
    dbChangeQuery($link, $sql, "categorie");
    closeConn($link);
}

//édition sql d'une categorie

function editCat($idCat, $nom, $description){
    $link = openConn();
    $sql = "UPDATE 
                `categorie` 
            SET `nom` = '".addslashes(utf8_decode($nom))."', 
                `description` = '".addslashes(utf8_decode($description))."'         
            WHERE `categorie`.`id` = ".$idCat.";";
    dbChangeQuery($link, $sql, "categorie");
    closeConn($link);
}

//suppression sql d'une catégorie

function deleteCat($idCat){
    //il faut supprimer en cascade les liens auteur_media existants
    $sql = "DELETE FROM `categorie` WHERE `categorie`.`id` = ".$idCat.";";
    $link = openConn();
    dbChangeQuery($link, $sql, "categorie");
    closeConn($link);
}

// ajout sql d'un média

function addMedia($idUtilisateur, $titre, $dateNow, $resume){
    $link = openConn();
    $sql = "INSERT INTO `media` 
                (`utilisateur_id`, 
                `titre`, 
                `date`, 
                `resume` ) 
            VALUES 
                (".$idUtilisateur.", 
                '".addslashes(utf8_decode($titre))."', 
                '".$dateNow."',
                '".addslashes(utf8_decode($resume))."');";
    dbChangeQuery($link, $sql, "media");
    closeConn($link);
}

//edition sql d'un média

function editMedia($idMedia, $titre, $resume){
    $link = openConn();
    $sql = "UPDATE 
                `media` 
            SET `titre` = '".addslashes(utf8_decode($titre))."', 
                `resume` = '".addslashes(utf8_decode($resume))."'                         
            WHERE `media`.`id` = ".$idMedia.";";
    dbChangeQuery($link, $sql, "media");
    closeConn($link);
}

//suppression sql d'un média

function deleteMedia($idMedia){
    //il faut supprimer en cascade les liens auteur_media existants
    $sqlKillLinks = "DELETE FROM `auteur_media` `a_l` WHERE `a_l`.`idmedia` = ".$idMedia.";";
    $sql = "DELETE FROM `media` WHERE `media`.`id` = ".$idMedia.";";
    $link = openConn();
    dbChangeQuery($link, $sqlKillLinks, "auteur_media");
    dbChangeQuery($link, $sql, "media");
    closeConn($link);
}

// ajout sql d'un lien entre un média et un auteur

function addLinkAthMd($idAuteur, $idMedia){
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
