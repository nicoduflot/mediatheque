<?php
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

function decodeCat($templateLine, $cat)
{
    $templateLine = str_replace("%nom%", utf8_encode(stripslashes($cat["nom"])), $templateLine);
    $templateLine = str_replace("%description%", utf8_encode(stripslashes($cat["description"])), $templateLine);
    $templateLine = str_replace("%editbutton%", utf8_encode(stripslashes($cat["editbutton"])), $templateLine);
    $templateLine = str_replace("%idCat%", utf8_encode(stripslashes($cat["idCat"])), $templateLine);
    return $templateLine;
}
