<?php
// debug functions
function printRResult($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

//variables globales
$ndResPPage = 10;
$pageNumber = 1;

function pagination($nbResultQuery, $nbPPages, $typePagination, $element){
    $pagination = "";
    $nbPages = ceil($nbResultQuery/$nbPPages);
    global $pageNumber;
    if($nbPages>$pageNumber){
        $pagination = $pagination."<span>Pages : ";
        for ($j=1;$j<=$nbPages;$j++){
            if($j==1){
                $classApplied = "pagination-items-selected";
            }else{
                $classApplied = "pagination-items";
            }
            $pagination = $pagination." <span id=\"". $typePagination .$j."\" onclick=\"pagination(".$j.", ".$nbPages.", '" . $element ."');\" class=\"".$classApplied."\">";
            $pagination = $pagination.$j;
            $pagination = $pagination."</span>";
        }
        $pagination = $pagination."</span>";
    }
    return $pagination;
}
// cette variable est globale pour la pagination des listes affichées front et back

//génération des liste front et back (auteurs et media)
//Liste des auteurs
function getAuthorList($env = "front"){
    //get the author list in a select input
    $sql = "SELECT `a`.*, COUNT(`m`.`id`) AS `NbLivre`
	FROM 
    	`auteur` `a` left join
        `auteur_media` `am` ON `a`.`id` = `am`.`idauteur` LEFT JOIN 
        `media` `m` ON `am`.`idmedia` = `m`.`id`
    GROUP BY `a`.`id` ORDER BY `a`.`nom`;";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    global $ndResPPage;
    $pagination = "";
    global $pageNumber;
    if($nbRows > 0){
        $pagination = pagination($nbRows, $ndResPPage, "pageNumberAuthor", "Author");
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
                    utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</a> " . utf8_encode($row["NbLivre"]) ." média enregistrés";
            }else{
                //liste dans l'admin
                echo "<a href=\"index.php?action=showAuteur&idAuteur=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["prenom"])." ".utf8_encode($row["nom"])."</a>";
                echo "<a href=\"index.php?action=editAuteur&idAuteur=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-success\">Editer</button></a>";
                echo "<a href=\"index.php?action=deleteAuteur&idAuteur=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-danger\">Supprimer</button></a> <span class=\"offset-1 col-lg-2\">" . utf8_encode($row["NbLivre"]) ." média enregistrés</span>";
            }
            echo "</li>";
            $i++;
        }
        echo "</ul>";
    }else{
        echo "0 résultat";
    }
}

//liste des media

function getMediaList($env = "front"){
    $sql = "SELECT 
	            `m`.`id`, `m`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`
            FROM 
	            `media` `m` LEFT JOIN 
	            `utilisateur` `u` ON `m`.`utilisateur_id` = `u`.`id` ORDER BY `m`.`titre`;";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    $pagination = "";
    global $pageNumber;
    global $ndResPPage;
    if($nbRows > 0){
        $pagination = pagination($nbRows, $ndResPPage, "pageNumberBook", "Book");
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
    //closeConn($link);
}

//Liste des catégories
function getCatList($env = "front"){
    $sql = "SELECT * FROM `categorie` `c` ORDER BY `c`.`nom`;";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    global $ndResPPage;
    $pagination = "";
    global $pageNumber;
    if($nbRows > 0){
        $pagination = pagination($nbRows, $ndResPPage, "pageNumberCat", "Cat");
        $i = 0;
        echo "<h4>Toutes les catégories</h4>";
        echo $pagination;
        echo "<ul id=\"listPaginationCat".$pageNumber."\" class=\"pagination-visible\">";
        while($i < $nbRows){
            $row = mysqli_fetch_assoc($result);
            $bgList = ($i%2 == 0) ? " style=\"background-color:#eee; margin-bottom: 2px;\"" : "style=\"margin-bottom: 2px;\"";
            if($i%$ndResPPage==0 && $i!=0){
                echo "</ul>";
                $pageNumber++;
                echo "<ul id=\"listPaginationCat".$pageNumber."\" class=\"pagination-hidden\">";
            }
            echo "<li class=\"row\"".$bgList.">";
            if($env == "front"){
                //liste dans le front
                echo "<a href=\"index.php?action=showCat&idCat=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["nom"]).
                    "</a>";
            }else{
                //liste dans l'admin
                echo "<a href=\"index.php?action=showCat&idCat=". $row["id"] . "\" class=\"col-lg-4\">".
                    utf8_encode($row["nom"])."</a>";
                echo "<a href=\"index.php?action=editCat&idCat=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-success\">Editer</button></a>";
                echo "<a href=\"index.php?action=deleteCat&idCat=".$row["id"]."\" class=\"col-lg-1\">
                    <button class=\"btn btn-danger\">Supprimer</button></a>";
            }
            echo "</li>";
            $i++;
        }
        echo "</ul>";
    }else{
        echo "0 résultat";
    }
}

// select de l'auteur pour le lien entre media et auteur

function createAuthorSelect(){
    $sql = "SELECT 
	            * 
            FROM 
	            `auteur` `a`
	        ORDER BY `a`.`nom`;";
    $result = selectBDD($sql);
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
}

// select du media pour le lien entre media et auteur

function createMediaSelect(){
    $sql = "SELECT 
	            * 
            FROM 
	            `media` `m`
	        ORDER BY 
	            `m`.`titre`;";
    $result = selectBDD($sql);
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
}

//createCatCheckBox
function createCatCheckBox($idMedia = ""){
    $whereFilter = "";
    $joinFilter = "";
    if($idMedia !== ""){
        $whereFilter = " WHERE `mc`.`idMedia` = ".$idMedia;
        $joinFilter = " LEFT JOIN `media_categorie` `mc` ON `c`.`id` = `mc`.`idMedia` ";
    }
    $sql = "SELECT `c`.`id` AS `idCategorie`, `c`.`nom` AS `nomCat` FROM `categorie` `c` ". $joinFilter . $whereFilter . ";";
    echo $sql;
}

//createCatSelect
function createCatSelect(){
    $sql = "SELECT 
	            * 
            FROM 
	            `categorie` `c`
	        ORDER BY `c`.`nom`;";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    $selectAuthor = "";
    $startSelect = "<select name=\"idCategorie\" id=\"idCategorie\" class=\"col-lg-9\" >";
    $selectOptions = "<option value=\"0\">Choisir une catégorie</option>";
    $endSelect = "</select>";
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $selectOptions .= "<option value=\"".$row["id"]."\">".utf8_encode($row["nom"])."</option>";
            $i++;
        }
        $selectAuthor = $startSelect.$selectOptions.$endSelect;
        return $selectAuthor;
    }else{
        $selectAuthor = $startSelect.$selectOptions.$endSelect;
        return $selectAuthor;
    }

}

//fonction de vérification pour la connexion d'un utilisateur

function getAuthentication($email, $password){
    $sql = "SELECT * FROM `utilisateur` WHERE `email` like '".$email."' AND ".
    " `motdepasse` LIKE '".$password."';";
    $result = selectBDD($sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        $_SESSION["accesAdmin"] = true;
        $_SESSION["utilisateur"] = $row["pseudo"];
        $_SESSION["idUtilisateur"] = $row["id"];
        return true;
    }else{
        return false;
    }
}

// récupération d'un auteur particulier

function getAuthor($id, $env = "front"){
    $media = "";
    $sql = "SELECT 
	            `a`.`id`, `a`.`nom`, `a`.`prenom`, `a`.`bio`, `m`.`id` as `idMedia`, `m`.`titre`
            FROM
                `auteur` `a` LEFT JOIN 
                `auteur_media` `a_m` ON `a`.`id` = `a_m`.`idauteur` LEFT JOIN 
                `media` `m` ON `a_m`.`idmedia` = `m`.`id`
            WHERE 
                `a`.`id` = ".$id." ;";
    $result = selectBDD($sql);
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
}

// récupération d'un media particulier.

function getMedia($id, $env = "front"){
    $sql = "SELECT 
	            `m`.`id`, `m`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`, 
	            `m`.`resume`, `m`.`date`, `a`.`nom`, `a`.`prenom`, `a`.`id` as `idauteur`, 
                `c`.`nom` as `categorie` 
            FROM 
	            `media` `m` LEFT JOIN 
	            `utilisateur` `u` ON `m`.`utilisateur_id` = `u`.`id` LEFT JOIN 
	             `auteur_media` `a_m` ON `m`.`id` = `a_m`.`idmedia` LEFT JOIN 
	             `auteur` `a` ON `a_m`.`idauteur` = `a`.`id` LEFT JOIN 
                 `media_categorie` `mc` ON `m`.`id` = `mc`.`idMedia` LEFT JOIN
                 `categorie` `c` ON `mc`.`idCategorie` = `c`.`id`
	        WHERE `m`.`id` = ".$id." ;";
    $auteur = "";
    $categorie = "";
    $editButton = "";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $auteur = $auteur . "<a href=\"index.php?action=showAuteur&idAuteur=".$row["idauteur"]."\">".$row["prenom"]." ".$row["nom"]."</a><br />";
            $categorie = $categorie . $row["categorie"]."<br />";
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
            "categorie" => $categorie,
            "idUtilisateur"=>$row["idUtilisateur"], "pseudo"=>$row["pseudo"],
            "resume"=>$row["resume"], "dateCreated"=>$row["date"],
            "nom"=>$row["nom"], "prenom"=>$row["prenom"], "idauteur"=>$row["idauteur"], "auteur"=>$auteur, "editbutton"=>$editButton];
    }else{
        //var_dump($_SESSION);
        return ["id"=>"", "titre"=>"",
            "categorie" => $categorie,
            "idUtilisateur"=>$_SESSION["idUtilisateur"], "pseudo"=>$_SESSION["utilisateur"],
            "resume"=>"", "dateCreated"=>"",
            "nom"=>"", "prenom"=>"", "idauteur"=>"", "auteur"=>$auteur, "editbutton"=>$editButton];
    }
}

function getCat($id, $env = "front"){
    $media = "";
    $sql = "SELECT 
	            `c`.`id`, `c`.`nom`, `c`.`description`
            FROM
                `categorie` `c`
            WHERE 
                `c`.`id` = ".$id." ;";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    $editButton = "";
    if($nbRows > 0){
        $i = 0;
        $row = mysqli_fetch_assoc($result);
        if($env != "front"){
            $editButton = "".
                "<a href=\"index.php?action=editCat&idCat=".$row["id"]."\">".
                "<button type=\"button\" name=\"editCat\" id=\"editCat\" class=\"btn btn-primary\">".
                "Editer".
                "</button>".
                "</a>";
        }
        return ["idCat"=>$row["id"], "nom"=>$row["nom"],
            "description"=>$row["description"], "editbutton"=>$editButton];
    }else{
        return ["idCat"=>"", "nom"=>"",
            "description"=>"", "editbutton"=>$editButton];
    }
}

// récupération du dernier media enregistré

function getLastMedia($env = "front"){
    $sql = "SELECT 
	            `m`.`id`, `m`.`titre`, `u`.`id` as `idUtilisateur`, `u`.`pseudo`, 
	            `m`.`resume`, `m`.`date`, `a`.`nom`, `a`.`prenom`, `a`.`id` as `idauteur`, 
                `c`.`nom` as `categorie` 
            FROM 
	            `media` `m` LEFT JOIN 
	            `utilisateur` `u` ON `m`.`utilisateur_id` = `u`.`id` LEFT JOIN 
	             `auteur_media` `a_m` ON `m`.`id` = `a_m`.`idmedia` LEFT JOIN 
	             `auteur` `a` ON `a_m`.`idauteur` = `a`.`id` LEFT JOIN 
                 `media_categorie` `mc` ON `m`.`id` = `mc`.`idMedia` LEFT JOIN
                 `categorie` `c` ON `mc`.`idCategorie` = `c`.`id`
	        ORDER BY 
	            `m`.`id` DESC LIMIT 1;";
    $auteur = "";
    $categorie = "";
    $editButton = "";
    $result = selectBDD($sql);
    $nbRows = mysqli_num_rows($result);
    if($nbRows > 0){
        $i = 0;
        while($i < $nbRows) {
            $row = mysqli_fetch_assoc($result);
            $auteur = $auteur . "<a href=\"index.php?action=showAuteur&idAuteur=".$row["idauteur"]."\">".$row["prenom"]." ".$row["nom"]."</a><br />";
            $categorie = $categorie . $row["categorie"]."<br />";
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
            "categorie" => $categorie,
            "idUtilisateur"=>$row["idUtilisateur"], "pseudo"=>$row["pseudo"],
            "resume"=>$row["resume"], "dateCreated"=>$row["date"],
            "nom"=>$row["nom"], "prenom"=>$row["prenom"], "idauteur"=>$row["idauteur"], "auteur"=>$auteur, "editbutton"=>$editButton];
    }else{
        return ["id"=>"", "titre"=>"",
            "categorie" => $categorie,
            "idUtilisateur"=>$_SESSION["idUtilisateur"], "pseudo"=>$_SESSION["utilisateur"],
            "resume"=>"", "dateCreated"=>"",
            "nom"=>"", "prenom"=>"", "idauteur"=>"", "auteur"=>$auteur, "editbutton"=>$editButton];
    }
}

// appel de la page de confirmation de la suppression d'un auteur ou d'un media

function showDelete($data){
    $pathFile = "../template/alertDelete.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeMedia(fread($template, filesize($pathFile)), $data, "back");
    }
}

function showDeleteAuthor($data){
    $pathFile = "../template/alertDeleteAuthor.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeAuthor(fread($template, filesize($pathFile)), $data, "back");
    }
}

function showDeleteCat($data){
    $pathFile = "../template/alertDeleteCat.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeCat(fread($template, filesize($pathFile)), $data, "back");
    }
}

function showMedia($media, $env = "front", $model = "media"){
    $pathFile = ($env != "front") ? "../" : "./";
    $pathFile = $pathFile.(($model != "media") ? "template/form" : "template/media");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeMedia(fread($template, filesize($pathFile.".html")), $media, $env);
    }
}

function showAuthor($media, $env = "front", $model = "author"){
    $pathFile = ($env != "front") ? "../" : "./";
    $pathFile = $pathFile.(($model != "author") ? "template/formAuthor" : "template/auteur");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeAuthor(fread($template, filesize($pathFile.".html")), $media);
    }
}

function showCat($cat, $env = "front", $model = "cat"){
    $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile.(($model != "cat") ? "template/formCategorie" : "template/categorie");
    //printRResult($pathFile.".html");
    if(!$template = fopen($pathFile.".html", "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeCat(fread($template, filesize($pathFile.".html")), $cat);
    }
}

function showLinkAuthorMedia($env = "front"){
    $pathFile = $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile."template/auteurMedia.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeLinkAthMd(fread($template, filesize($pathFile)), createAuthorSelect(), createMediaSelect());
    }
}

//showLinkCatMedia
function showLinkCatMedia($env = "front"){
    $pathFile = $pathFile = ($env != "front") ? "../" : "";
    $pathFile = $pathFile."template/categorieMedia.html";
    if(!$template = fopen($pathFile, "r")){
        echo "Echec de l'ouverture du fichier";
        exit;
    }else{
        echo decodeLinkCatMd(fread($template, filesize($pathFile)), createCatSelect(), createMediaSelect());
    }
}
