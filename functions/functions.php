<?php

// debug functions
function printRResult($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function getAuthorList($env = "front"){
    //get the author list in a select input
    $link = openConn();
    $sql = "SELECT * FROM `auteur`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        echo "<ul>";
        while($i < $nbRows){
            $row = mysqli_fetch_assoc($result);
            $bgList = ($i%2 == 0) ? " style=\"background-color:#eee; margin-bottom: 2px;\"" : "style=\"margin-bottom: 2px;\"";
            echo "<li class=\"row\"".$bgList.">";
            if($env == "front"){
                //liste dans le front
                echo "<a href=\"index.php?action=showAuteur&idAuteur=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</a>";
            }else{
                //liste dans l'admin
                echo "<a href=\"index.php?action=showAuteur&idAuteur=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</a>";
                echo "<a href=\"index.php?action=editAuteur&idAuteur=".$row["id"]."\" class=\"col-lg-3\">
                    <button class=\"btn btn-success\">Editer l'auteur</button></a>";
                echo "<a href=\"index.php?action=deleteAuteur&idAuteur=".$row["id"]."\" class=\"col-lg-3\">
                    <button class=\"btn btn-danger\">Supprimer l'auteur</button></a>";
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

function getAuthor($id, $env = "front"){
    $link = openConn();
    $livre = "";
    $sql = "SELECT 
	            `a`.`id`, `a`.`nom`, `a`.`prenom`, `a`.`bio`, `l`.`id` as `idLivre`, `l`.`titre`
            FROM
                `auteur` `a` LEFT JOIN 
                `auteur_livre` `a_l` ON `a`.`id` = `a_l`.`idauteur` LEFT JOIN 
                `livre` `l` ON `a_l`.`idlivre` = `l`.`id`
            WHERE 
                `a`.`id` = ".$id." ;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    $editButton = "";
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $livre = $livre . "<a href=\"index.php?action=livre&idLivre=".$row["idLivre"]."\">".$row["titre"]."</a><br />";
            $i++;
        }
        //$row = mysqli_fetch_assoc($result);
        //printRResult($row);
        if($env != "front"){
            $editButton = "".
                "<a href=\"index.php?action=editAuteur&idAuteur=".$row["id"]."\">".
                "<button type=\"button\" name=\"editAuteur\" id=\"editAuteur\" class=\"btn btn-primary\">".
                "Editer".
                "</button>".
                "</a>";
        }
        return ["idAuteur"=>$row["id"], "prenom"=>$row["prenom"],
            "nom"=>$row["nom"], "bio"=>$row["bio"], "livreAuteur" =>$livre, "editbutton"=>$editButton];
    }else{
        return ["idAuteur"=>"", "prenom"=>"",
            "nom"=>"", "bio"=>"", "livreAuteur" =>$livre, "editbutton"=>$editButton];
    }
    closeConn($link);
}

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

function createBookSelect(){
    $link = openConn();
    $sql = "SELECT 
	            * 
            FROM 
	            `livre` `l`
	        ORDER BY 
	            `l`.`titre`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    $selectBook = "";
    $startSelect = "<select name=\"idLivre\" id=\"idLivre\" class=\"col-lg-9\" >";
    $selectOptions = "<option value=\"0\">Choisir un livre</option>";
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

function decodeBook($templateLine, $livre, $env = "front"){
    $pathFile = ($env != "front") ? "../" : "";
    $templateLine = str_replace("%titre%", utf8_encode(stripslashes($livre["titre"])), $templateLine);
    $templateLine = str_replace("%dateCreated%", utf8_encode(stripslashes($livre["dateCreated"])), $templateLine);
    $templateLine = str_replace("%resume%", utf8_encode(stripslashes($livre["resume"])), $templateLine);
    $templateLine = str_replace("%nom%", utf8_encode(stripslashes($livre["nom"])), $templateLine);
    $templateLine = str_replace("%prenom%", utf8_encode(stripslashes($livre["prenom"])), $templateLine);
    $templateLine = str_replace("%idauteur%", utf8_encode(stripslashes($livre["idauteur"])), $templateLine);
    $templateLine = str_replace("%auteur%", utf8_encode(stripslashes($livre["auteur"])), $templateLine);
    $templateLine = str_replace("%editbutton%", utf8_encode(stripslashes($livre["editbutton"])), $templateLine);
    $templateLine = str_replace("%env%", utf8_encode(stripslashes($pathFile)), $templateLine);
    $templateLine = str_replace("%idLivre%", utf8_encode(stripslashes($livre["id"])), $templateLine);
    $templateLine = str_replace("%idUtilisateur%", utf8_encode(stripslashes($livre["idUtilisateur"])), $templateLine);
    return $templateLine;
}

function decodeAuthor($templateLine, $livre)
{
    $templateLine = str_replace("%prenom%", utf8_encode(stripslashes($livre["prenom"])), $templateLine);
    $templateLine = str_replace("%nom%", utf8_encode(stripslashes($livre["nom"])), $templateLine);
    $templateLine = str_replace("%bio%", utf8_encode(stripslashes($livre["bio"])), $templateLine);
    $templateLine = str_replace("%livreAuteur%", utf8_encode(stripslashes($livre["livreAuteur"])), $templateLine);
    $templateLine = str_replace("%editbutton%", utf8_encode(stripslashes($livre["editbutton"])), $templateLine);
    $templateLine = str_replace("%idAuteur%", utf8_encode(stripslashes($livre["idAuteur"])), $templateLine);
    return $templateLine;
}

function decodeLinkAthBk($templateLine, $listeAuteur, $listeLivre){
    $templateLine = str_replace("%listeAuteur%", $listeAuteur, $templateLine);
    $templateLine = str_replace("%listeLivre%", $listeLivre, $templateLine);
    return $templateLine;
}

function dbChangeQuery($link, $sql, $table){
    if(mysqli_query($link, $sql)){
        echo "La table `".$table."` a bien été modifiée<br />";
    }else{
        echo "erreur : ". utf8_decode($sql) ."<br />". mysqli_error($link);
    }
}

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

function getBook($id, $env = "front"){
    $link = openConn();
    $sql = "SELECT 
	            `l`.`id`, `l`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`, 
	            `l`.`resume`, `l`.`date`, `a`.`nom`, `a`.`prenom`, `a`.`id` as `idauteur` 
            FROM 
	            `livre` `l` LEFT JOIN 
	            `utilisateur` `u` ON `l`.`utilisateur_id` = `u`.`id` LEFT JOIN 
	             `auteur_livre` `a_l` ON `l`.`id` = `a_l`.`idlivre` LEFT JOIN 
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
                "<a href=\"index.php?action=edit&idLivre=".$row["id"]."\">".
                "<button type=\"button\" name=\"editLivre\" id=\"editLivre\" class=\"btn btn-primary\">".
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

function getLastBook(){
    $link = openConn();
    $sql = "SELECT 
	            `l`.`id`, `l`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`,
	            `l`.`resume`, `l`.`date` 
            FROM 
	            `livre` `l` LEFT JOIN 
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

function getBookList($env = "front"){
    $link = openConn();
    $sql = "SELECT 
	            `l`.`id`, `l`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`
            FROM 
	            `livre` `l` LEFT JOIN 
	            `utilisateur` `u` ON `l`.`utilisateur_id` = `u`.`id`;";
    $result = mysqli_query($link, $sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        echo "<ul>";
        while($i < $nbRows){
            $row = mysqli_fetch_assoc($result);
            $bgList = ($i%2 == 0) ? " style=\"background-color:#eee; margin-bottom: 2px;\"" : "style=\"margin-bottom: 2px;\"";
            echo "<li class=\"row\"".$bgList.">";
            if($env == "front"){
                //liste dans le front
                echo "<a href=\"index.php?action=livre&idLivre=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["titre"])."</a>";
                echo "<i class=\"col-lg-1\">".$row["pseudo"]."</i>";
            }else{
                //liste dans l'admin
                echo "<a href=\"index.php?action=livre&idLivre=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["titre"])."</a>";
                echo "<a href=\"index.php?action=edit&idLivre=".$row["id"]."\" class=\"col-lg-2\">
                    <button class=\"btn btn-success\">Editer le livre</button></a>";
                echo "<a href=\"index.php?action=delete&idLivre=".$row["id"]."\" class=\"col-lg-2\">
                    <button class=\"btn btn-danger\">Supprimer le livre</button></a>";
                echo "<i class=\"col-lg-1\">".$row["pseudo"]."</i>";
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

function showDelete($data){
    $pathFile = "../template/alertDelete.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        while(!feof($template)){
            echo decodeBook(fgets($template), $data, "back");
        }
    }
}

function showBook($livre, $env = "front", $model = "livre"){
    $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile.(($model != "livre") ? "template/form" : "template/livre");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        while(!feof($template)){
            echo decodeBook(fgets($template), $livre, $env);
        }
    }
}

function showAuthor($livre, $env = "front", $model = "author"){
    $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile.(($model != "author") ? "template/formAuthor" : "template/auteur");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{

        while(!feof($template)){
            echo decodeAuthor(fgets($template), $livre);
        }
    }
}

function showLinkAuthorBook($env = "front"){
    $pathFile = $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile."template/auteurLivre.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{

        while(!feof($template)){
            echo decodeLinkAthBk(fgets($template), createAuthorSelect(), createBookSelect());
        }
    }
}