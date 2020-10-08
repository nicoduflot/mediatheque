<?php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Médiathèque <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=list">Tous les Média</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=authorList">Tous les auteurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=catList">Toutes les catégories</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?action=add">Ajouter Média</a>
                    <a class="dropdown-item" href="index.php?action=addAuthor">Ajouter auteur</a>
                    <a class="dropdown-item" href="index.php?action=addCat">Ajouter une catégorie</a>
                    <a class="dropdown-item" href="index.php?action=linkAuthor">Lier Auteur - Média</a>
                    <a class="dropdown-item" href="index.php?action=linkCat">Lier Catégorie - Média</a>
                    <!--
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    -->
                </div>
            </li>

            <?php
            if(isset($_SESSION["accesAdmin"]) && $_SESSION["accesAdmin"]){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?security=on">Déconnexion</a>
                </li>
                <?php
            }else{
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="back/index.php">Connexion</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
