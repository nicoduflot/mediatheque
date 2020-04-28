<?php
session_start();
include "../includes/connection.php";
include "../functions/functions.php";

if(isset($_POST["submitForm"])){
    $email = strip_tags(addslashes($_POST["email"]));
    $password = md5(strip_tags(addslashes($_POST["motdepasse"])));
    if(getAuthentication($email, $password)){
        header('location: index.php');
    }
}

if(isset($_GET["security"]) && !isset($_SESSION["accesAdmin"])){
    if($_GET["security"] == "on"){
        $_SESSION["accesAdmin"] = false;
        header('location: index.php');
    }
}elseif(isset($_GET["security"]) && isset($_GET["security"]) == "on"){
    $_SESSION["accesAdmin"] = false;
    header('location: index.php');
}
/*elseif (isset($_GET["security"]) && isset($_SESSION["accesAdmin"])){
    if($_GET["security"] == "on"){
        $_SESSION["accesAdmin"] = false;
        //header('location: index.php');
    }
}else{
    $_SESSION["accesAdmin"] = false;
}
*/

?>
<!doctype HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin médiathèque</title>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/functions.js"></script>
    </head>
    <body class="container">
        <?php if(!isset($_SESSION["accesAdmin"]) || $_SESSION["accesAdmin"] == false){ ?>
        <section>
            <h2>Authentification</h2>
            <form method="post">
                <div class="form-group row">
                    <label for="email" class="col-lg-2 offset-2">Email</label>
                    <input name="email" type="text" class="col-lg-6" />
                </div>
                <div class="form-group row">
                    <label for="motdepasse" class="col-lg-2 offset-2">Mot de passe</label>
                    <input name="motdepasse" type="password" class="col-lg-6" />
                </div>
                <p class="offset-2">
                    <button name="submitForm" type="submit" value="envoyer" class="btn btn-primary">
                        Envoyer
                    </button>
                </p>
            </form>
            <a href="../index.php">retour médiathèque</a>
        </section>
        <?php }else{
            ?>
            <header>
                <?php include "../includes/adminMenu.php"; ?>
            </header>
            <!-- <?php echo createAuthorSelect(); ?>&nbsp;<?php echo createMediaSelect(); ?> -->
            <section>
                <?php include "../includes/adminContenu.php"; ?>
            </section>
        <?php
        } ?>
    </body>
</html>

