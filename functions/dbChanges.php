<?php
//fonction d'éxécution d'une requête sql

function dbChangeQuery($sql, $table){
    $link = openConn();
    if(mysqli_query($link, $sql)){
        echo "La table `".$table."` a bien été modifiée<br />";
    }else{
        echo "erreur : ". utf8_decode($sql) ."<br />". mysqli_error($link);
    }
    closeConn($link);
}

//fonction de requete de select
function selectBDD($sql){
    $link = openConn();
    $result = mysqli_query($link, $sql);
    closeConn($link);
    return $result;
}

//ajout sql d'un auteur

function addAuthor($nom, $prenom, $bio){
    $sql = "INSERT INTO `auteur` 
                    (`nom`, 
                    `prenom`, 
                    `bio` ) VALUES 
                    ('".addslashes(utf8_decode($nom))."', 
                    '".addslashes(utf8_decode($prenom))."',
                    '".addslashes(utf8_decode($bio))."');";
    dbChangeQuery($sql, "auteur");
}

//édition sql d'un auteur

function editAuthor($idAuteur, $nom, $prenom, $bio){
    $sql = "UPDATE 
                `auteur` 
            SET `nom` = '".addslashes(utf8_decode($nom))."', 
                `prenom` = '".addslashes(utf8_decode($prenom))."',                         
                `bio` = '".addslashes(utf8_decode($bio))."'                         
            WHERE `auteur`.`id` = ".$idAuteur.";";
    dbChangeQuery($sql, "auteur");
}

//suppression sql d'un auteur et des lien qu'il peut avoir avec des média

function deleteAuthor($idAuteur){
    //il faut supprimer en cascade les liens auteur_media existants
    $sqlKillLinks = "DELETE FROM `auteur_media` `a_l` WHERE `a_l`.`idauteur` = ".$idAuteur.";";
    $sql = "DELETE FROM `auteur` WHERE `auteur`.`id` = ".$idAuteur.";";
    dbChangeQuery($sqlKillLinks, "auteur_media");
    dbChangeQuery($sql, "auteur");
}

//ajout sql d'une catégorie

function addCat($nom, $description){
    $sql = "INSERT INTO `categorie` 
                    (`nom`, 
                    `description`) VALUES 
                    ('".addslashes(utf8_decode($nom))."', 
                    '".addslashes(utf8_decode($description))."');";
    dbChangeQuery($sql, "categorie");
}

//édition sql d'une categorie

function editCat($idCat, $nom, $description){
    $sql = "UPDATE 
                `categorie` 
            SET `nom` = '".addslashes(utf8_decode($nom))."', 
                `description` = '".addslashes(utf8_decode($description))."'         
            WHERE `categorie`.`id` = ".$idCat.";";
    dbChangeQuery($sql, "categorie");
}

//suppression sql d'une catégorie

function deleteCat($idCat){
    //il faut supprimer en cascade les liens auteur_media existants
    $sqlKillLinks = "DELETE FROM `media_categorie` `mc` WHERE `mc`.`idmedia` = ".$idMedia.";";
    $sql = "DELETE FROM `categorie` WHERE `categorie`.`id` = ".$idCat.";";
    dbChangeQuery($sqlKillLinks, "media_categorie");
    dbChangeQuery($sql, "categorie");
}

// ajout sql d'un média

function addMedia($idUtilisateur, $titre, $dateNow, $resume){
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
    dbChangeQuery($sql, "media");
}

//edition sql d'un média

function editMedia($idMedia, $titre, $resume){
    $sql = "UPDATE 
                `media` 
            SET `titre` = '".addslashes(utf8_decode($titre))."', 
                `resume` = '".addslashes(utf8_decode($resume))."'                         
            WHERE `media`.`id` = ".$idMedia.";";
    dbChangeQuery($sql, "media");
}

//suppression sql d'un média

function deleteMedia($idMedia){
    //il faut supprimer en cascade les liens auteur_media existants
    $sqlKillLinks = "DELETE FROM `auteur_media` `a_l` WHERE `a_l`.`idmedia` = ".$idMedia.";";
    $sql = "DELETE FROM `media` WHERE `media`.`id` = ".$idMedia.";";
    dbChangeQuery($sqlKillLinks, "auteur_media");
    dbChangeQuery($sql, "media");
}

// ajout sql d'un lien entre un média et un auteur

function addLinkAthMd($idAuteur, $idMedia){
    $sql = "SELECT 
	            * 
            FROM 
	            `auteur_media` `l` 
	        WHERE 
	            `idauteur` = ".$idAuteur." 
	            AND `idMedia` = ".$idMedia.";";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows == 0 && $idAuteur !=0 && $idMedia != 0) {
        $sql = "INSERT INTO `auteur_media` 
                        (`idauteur`, 
                        `idmedia`) VALUES 
                        (" . $idAuteur . ", 
                        " . $idMedia . ");";
        dbChangeQuery($sql, "auteur_media");
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
}

//addLinkCatMd
function addLinkCatMd($idCat, $idMedia){
    $sql = "SELECT 
	            * 
            FROM 
	            `media_categorie` `l` 
	        WHERE 
	            `idCategorie` = ".$idCat." 
	            AND `idMedia` = ".$idMedia.";";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows == 0 && $idCat !=0 && $idMedia != 0) {
        $sql = "INSERT INTO `media_categorie` 
                        (`idCategorie`, 
                        `idmedia`) VALUES 
                        (" . $idCat . ", 
                        " . $idMedia . ");";
        dbChangeQuery($sql, "media_categorie");
        header("location: index.php?action=list");
    }
    else{
        if($nbRows != 0){
            echo "Ce lien existe déjà";
        }elseif ($idMedia == 0 && $idAuteur == 0){
            echo "Vous devez choisir une catégorie ET un Media";
        }elseif($idMedia == 0){
            echo "Vous devez choisir une catégorie";
        }else{
            echo "Vous devez choisir un auteur";
        }
    }
}
