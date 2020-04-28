<?php

// debug functions
function printRResult($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
// cette variable est globale pour la pagination des listes affichées front et back
$ndResPPage = 10;

//génération des liste front et back (auteurs et media)

//Liste des auteurs

function getAuthorList($env = "front"){
    //get the author list in a select input
    $link = openConn();
    $sql = "SELECT * FROM `auteur` `a` ORDER BY `a`.`nom`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    global $ndResPPage;
    $pagination = "";
    if($nbRows > 0){
        $nbPages = ceil($nbRows/$ndResPPage);
        $pageNumber = 1;
        if($nbPages>$pageNumber){
            $pagination = $pagination."<span>Pages : ";
            for ($j=1;$j<=$nbPages;$j++){
                if($j==1){
                    $classApplied = "pagination-items-selected";
                }else{
                    $classApplied = "pagination-items";
                }
                $pagination = $pagination." <span id=\"pageNumberAuthor".$j."\" onclick=\"pagination(".$j.", ".$nbPages.", 'Author');\" class=\"".$classApplied."\">";
                $pagination = $pagination.$j;
                $pagination = $pagination."</span>";
            }
            $pagination = $pagination."</span>";
        }

        $i = 0;
        echo "<h4>Tous les auteurs</h4>";
        echo $pagination;
        echo "<ul id=\"listPaginationAuthor".$pageNumber."\" class=\"pagination-visible\">";
        while($i < $nbRows){
            $row = mysqli_fetch_assoc($result);
            $bgList = ($i%2 == 0) ? " style=\"background-color:#eee; margin-bottom: 2px;\"" : "style=\"margin-bottom: 2px;\"";
            if($i%$ndResPPage==0 && $i!=0){
                echo "</ul>";
                $pageNumber++;
                echo "<ul id=\"listPaginationAuthor".$pageNumber."\" class=\"pagination-hidden\">";
            }
            echo "<li class=\"row\"".$bgList.">";
            if($env == "front"){
                //liste dans le front
                echo "<a href=\"index.php?action=showAuteur&idAuteur=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</a>";
            }else{
                //liste dans l'admin
                echo "<a href=\"index.php?action=showAuteur&idAuteur=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</a>";
                echo "<a href=\"index.php?action=editAuteur&idAuteur=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-success\">Editer</button></a>";
                echo "<a href=\"index.php?action=deleteAuteur&idAuteur=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-danger\">Supprimer</button></a>";
            }
            echo "</li>";
            $i++;
        }
        echo "</ul>";
    }else{
        echo "0 résultat";
    }
    closeConn($link);
}

//liste des media

function getMediaList($env = "front"){
    $link = openConn();
    $sql = "SELECT 
	            `l`.`id`, `l`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`
            FROM 
	            `media` `l` LEFT JOIN 
	            `utilisateur` `u` ON `l`.`utilisateur_id` = `u`.`id` ORDER BY `l`.`titre`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    $pagination = "";
    global $ndResPPage;
    if($nbRows > 0){
        $nbPages = ceil($nbRows/$ndResPPage);
        $pageNumber = 1;
        if($nbPages>$pageNumber){
            $pagination = $pagination."<span>Pages : ";
            for ($j=1;$j<=$nbPages;$j++){
                if($j==1){
                    $classApplied = "pagination-items-selected";
                }else{
                    $classApplied = "pagination-items";
                }
                $pagination = $pagination." <span id=\"pageNumberBook".$j."\" onclick=\"pagination(".$j.", ".$nbPages.", 'Book');\" class=\"".$classApplied."\">";
                $pagination = $pagination.$j;
                $pagination = $pagination."</span>";
            }
            $pagination = $pagination."</span>";
        }

        $i = 0;
        echo "<h4>Tous les Média</h4>";
        echo $pagination;
        echo "<ul id=\"listPaginationBook".$pageNumber."\" class=\"pagination-visible\">";
        while($i < $nbRows){
            $row = mysqli_fetch_assoc($result);
            $bgList = ($i%2 == 0) ? " style=\"background-color:#eee; margin-bottom: 2px;\"" : "style=\"margin-bottom: 2px;\"";
            if($i%$ndResPPage==0 && $i!=0){
                echo "</ul>";
                $pageNumber++;
                echo "<ul id=\"listPaginationBook".$pageNumber."\" class=\"pagination-hidden\">";
            }

            echo "<li class=\"row\"".$bgList.">";
            if($env == "front"){
                //liste dans le front
                echo "<a href=\"index.php?action=media&idMedia=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["titre"])."</a>";
                echo "<i class=\"col-lg-1\">".$row["pseudo"]."</i>";
            }else{
                //liste dans l'admin
                echo "<a href=\"index.php?action=media&idMedia=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["titre"])."</a>";
                echo "<a href=\"index.php?action=edit&idMedia=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-success\">Editer</button></a>";
                echo "<a href=\"index.php?action=delete&idMedia=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-danger\">Supprimer</button></a>";
            }
            echo "</li>";
            $i++;
        }
        echo "</ul>";
    }else{
        echo "0 résultat";
    }
    closeConn($link);
}

// select de l'auteur pour le lien entre media et auteur

function createAuthorSelect(){
    $link = openConn();
    $sql = "SELECT 
	            * 
            FROM 
	            `auteur` `a`
	        ORDER BY `a`.`nom`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    $selectAuthor = "";
    $startSelect = "<select name=\"idAuteur\" id=\"idAuteur\" class=\"col-lg-9\" >";
    $selectOptions = "<option value=\"0\">Choisir un auteur</option>";
    $endSelect = "</select>";
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $selectOptions .= "<option value=\"".$row["id"]."\">".utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</option>";
            $i++;
        }
        $selectAuthor = $startSelect.$selectOptions.$endSelect;
        return $selectAuthor;
    }else{
        $selectAuthor = $startSelect.$selectOptions.$endSelect;
        return $selectAuthor;
    }
    closeConn($link);
}

// select du media pour le lien entre media et auteur

function createMediaSelect(){
    $link = openConn();
    $sql = "SELECT 
	            * 
            FROM 
	            `media` `l`
	        ORDER BY 
	            `l`.`titre`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    $selectBook = "";
    $startSelect = "<select name=\"idMedia\" id=\"idMedia\" class=\"col-lg-9\" >";
    $selectOptions = "<option value=\"0\">Choisir un Média</option>";
    $endSelect = "</select>";
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $selectOptions .= "<option value=\"".$row["id"]."\">".utf8_encode($row["titre"])."</option>";
            $i++;
        }
        $selectBook = $startSelect.$selectOptions.$endSelect;
        return $selectBook;
    }else{
        $selectBook = $startSelect.$selectOptions.$endSelect;
        return $selectBook;
    }
    closeConn($link);
}

//templating pour l'affichage et l'édition d'un media

function decodeMedia($templateLine, $media, $env = "front"){
    $pathFile = ($env != "front") ? "../" : "";
    $templateLine = str_replace("%titre%", utf8_encode(stripslashes($media["titre"])), $templateLine);
    $templateLine = str_replace("%dateCreated%", utf8_encode(stripslashes($media["dateCreated"])), $templateLine);
    $templateLine = str_replace("%resume%", utf8_encode(stripslashes($media["resume"])), $templateLine);
    $templateLine = str_replace("%nom%", utf8_encode(stripslashes($media["nom"])), $templateLine);
    $templateLine = str_replace("%prenom%", utf8_encode(stripslashes($media["prenom"])), $templateLine);
    $templateLine = str_replace("%idauteur%", utf8_encode(stripslashes($media["idauteur"])), $templateLine);
    $templateLine = str_replace("%auteur%", utf8_encode(stripslashes($media["auteur"])), $templateLine);
    $templateLine = str_replace("%editbutton%", utf8_encode(stripslashes($media["editbutton"])), $templateLine);
    $templateLine = str_replace("%env%", utf8_encode(stripslashes($pathFile)), $templateLine);
    $templateLine = str_replace("%idMedia%", utf8_encode(stripslashes($media["id"])), $templateLine);
    $templateLine = str_replace("%idUtilisateur%", utf8_encode(stripslashes($media["idUtilisateur"])), $templateLine);
    return $templateLine;
}

//templating pour l'affichage et l'édition d'un auteur

function decodeAuthor($templateLine, $media)
{
    $templateLine = str_replace("%prenom%", utf8_encode(stripslashes($media["prenom"])), $templateLine);
    $templateLine = str_replace("%nom%", utf8_encode(stripslashes($media["nom"])), $templateLine);
    $templateLine = str_replace("%bio%", utf8_encode(stripslashes($media["bio"])), $templateLine);
    $templateLine = str_replace("%mediaAuteur%", utf8_encode(stripslashes($media["mediaAuteur"])), $templateLine);
    $templateLine = str_replace("%editbutton%", utf8_encode(stripslashes($media["editbutton"])), $templateLine);
    $templateLine = str_replace("%idAuteur%", utf8_encode(stripslashes($media["idAuteur"])), $templateLine);
    return $templateLine;
}

//templating pour le formulaire de lien entre un auteur et un media.

function decodeLinkAthMd($templateLine, $listeAuteur, $listeMedia){
    $templateLine = str_replace("%listeAuteur%", $listeAuteur, $templateLine);
    $templateLine = str_replace("%listeMedia%", $listeMedia, $templateLine);
    return $templateLine;
}

//fonction d'éxécution d'une requête sql

function dbChangeQuery($link, $sql, $table){
    if(mysqli_query($link, $sql)){
        echo "La table `".$table."` a bien été modifiée<br />";
    }else{
        echo "erreur : ". utf8_decode($sql) ."<br />". mysqli_error($link);
    }
}

//fonction de vérification pour la connexion d'un utilisateur

function getAuthentication($email, $password){
    $link = openConn();
    $sql = "SELECT * FROM `utilisateur` WHERE `email` like '".$email."' AND ".
    " `motdepasse` LIKE '".$password."';";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        $_SESSION["accesAdmin"] = true;
        $_SESSION["utilisateur"] = $row["pseudo"];
        $_SESSION["idUtilisateur"] = $row["id"];
        closeConn($link);
        return true;
    }else{
        closeConn($link);
        return false;
    }
}

// récupération d'un auteur particulier

function getAuthor($id, $env = "front"){
    $link = openConn();
    $media = "";
    $sql = "SELECT 
	            `a`.`id`, `a`.`nom`, `a`.`prenom`, `a`.`bio`, `l`.`id` as `idMedia`, `l`.`titre`
            FROM
                `auteur` `a` LEFT JOIN 
                `auteur_media` `a_l` ON `a`.`id` = `a_l`.`idauteur` LEFT JOIN 
                `media` `l` ON `a_l`.`idmedia` = `l`.`id`
            WHERE 
                `a`.`id` = ".$id." ;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    $editButton = "";
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $media = $media . "<a href=\"index.php?action=media&idMedia=".$row["idMedia"]."\">".$row["titre"]."</a><br />";
            $i++;
        }
        if($env != "front"){
            $editButton = "".
                "<a href=\"index.php?action=editAuteur&idAuteur=".$row["id"]."\">".
                "<button type=\"button\" name=\"editAuteur\" id=\"editAuteur\" class=\"btn btn-primary\">".
                "Editer".
                "</button>".
                "</a>";
        }
        return ["idAuteur"=>$row["id"], "prenom"=>$row["prenom"],
            "nom"=>$row["nom"], "bio"=>$row["bio"], "mediaAuteur" =>$media, "editbutton"=>$editButton];
    }else{
        return ["idAuteur"=>"", "prenom"=>"",
            "nom"=>"", "bio"=>"", "mediaAuteur" =>$media, "editbutton"=>$editButton];
    }
    closeConn($link);
}

// récupération d'un media particulier.

function getMedia($id, $env = "front"){
    $link = openConn();
    $sql = "SELECT 
	            `l`.`id`, `l`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`, 
	            `l`.`resume`, `l`.`date`, `a`.`nom`, `a`.`prenom`, `a`.`id` as `idauteur` 
            FROM 
	            `media` `l` LEFT JOIN 
	            `utilisateur` `u` ON `l`.`utilisateur_id` = `u`.`id` LEFT JOIN 
	             `auteur_media` `a_l` ON `l`.`id` = `a_l`.`idmedia` LEFT JOIN 
	             `auteur` `a` ON `a_l`.`idauteur` = `a`.`id`  
	        WHERE `l`.`id` = ".$id." ;";
    //printRResult($sql);
    $auteur = "";
    $editButton = "";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $auteur = $auteur . "<a href=\"index.php?action=showAuteur&idAuteur=".$row["idauteur"]."\">".$row["prenom"]." ".$row["nom"]."</a><br />";
            $i++;
        }
        if($env != "front"){
            $editButton = "".
                "<a href=\"index.php?action=edit&idMedia=".$row["id"]."\">".
                "<button type=\"button\" name=\"editMedia\" id=\"editMedia\" class=\"btn btn-primary\">".
                "Editer".
                "</button>".
                "</a>";
        }
        return ["id"=>$row["id"], "titre"=>$row["titre"],
            "idUtilisateur"=>$row["idUtilisateur"], "pseudo"=>$row["pseudo"],
            "resume"=>$row["resume"], "dateCreated"=>$row["date"],
            "nom"=>$row["nom"], "prenom"=>$row["prenom"], "idauteur"=>$row["idauteur"], "auteur"=>$auteur, "editbutton"=>$editButton];
    }else{
        return ["id"=>"", "titre"=>"",
            "idUtilisateur"=>$_SESSION["idUtilisateur"], "pseudo"=>$_SESSION["utilisateur"],
            "resume"=>"", "dateCreated"=>"",
            "nom"=>"", "prenom"=>"", "idauteur"=>"", "auteur"=>"", "editbutton"=>$editButton];
    }
    closeConn($link);
}

// récupération du dernier media enregistré

function getLastMedia(){
    $link = openConn();
    $sql = "SELECT 
	            `l`.`id`, `l`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`,
	            `l`.`resume`, `l`.`date` 
            FROM 
	            `media` `l` LEFT JOIN 
	            `utilisateur` `u` ON `l`.`utilisateur_id` = `u`.`id`
	        ORDER BY 
	            `l`.`id` DESC LIMIT 1;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $row = mysqli_fetch_assoc($result);
        return ["id"=>$row["id"], "titre"=>$row["titre"],
            "idUtilisateur"=>$row["idUtilisateur"], "pseudo"=>$row["pseudo"],
            "resume"=>$row["resume"], "dateCreated"=>$row["date"]];
    }
    closeConn($link);
}

// appel de la page de confirmation de la suppression d'un auteur ou d'un media

function showDelete($data){
    $pathFile = "../template/alertDelete.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        while(!feof($template)){
            echo decodeMedia(fgets($template), $data, "back");
        }
    }
}

function showDeleteAuthor($data){
    $pathFile = "../template/alertDeleteAuthor.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        while(!feof($template)){
            echo decodeAuthor(fgets($template), $data, "back");
        }
    }
}

function showMedia($media, $env = "front", $model = "media"){
    $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile.(($model != "media") ? "template/form" : "template/media");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        while(!feof($template)){
            echo decodeMedia(fgets($template), $media, $env);
        }
    }
}

function showAuthor($media, $env = "front", $model = "author"){
    $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile.(($model != "author") ? "template/formAuthor" : "template/auteur");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{

        while(!feof($template)){
            echo decodeAuthor(fgets($template), $media);
        }
    }
}

function showLinkAuthorMedia($env = "front"){
    $pathFile = $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile."template/auteurMedia.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{

        while(!feof($template)){
            echo decodeLinkAthMd(fgets($template), createAuthorSelect(), createMediaSelect());
        }
    }
}
