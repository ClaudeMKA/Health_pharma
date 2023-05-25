<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');


if (!isLogged()){
    die('404');
}

global $pdo;
$sql = "SELECT * FROM `user-vaccin`";
$query = $pdo->prepare($sql);
$query->execute();
$users = $query->fetchAll();

$sessionid = $_SESSION['user']['id'];

$sqlBase = "SELECT uv.*, u.email, v.title, v.description FROM `user-vaccin` uv
    INNER JOIN  user u
        ON uv.id_user =  u.id
    INNER JOIN vaccin v  ON uv.id_vaccin = v.id WHERE uv.id_user =:sessionid";
$query = $pdo->prepare($sqlBase);
$query->bindValue('sessionid', $sessionid, PDO::PARAM_STR);
$query->execute();
$mixte = $query->fetchAll();

include('inc/header.php'); ?>

<section id="intro2">
    <div class="container1">
        <div class="text_intro">
            <p>Bienvenue sur votre espace perso <span style="text-transform: uppercase"> <?php echo $_SESSION['user']['prenom'];?></span>
            </p>
        </div>
        <?php if (empty($mixte)) { ?>
            <a href="form_carnet.php">Créer votre carnet</a>
        <?php } else { ?>
            <a href="carnet.php">Voir votre carnet</a>
        <?php }?>


    </div>
</section>

<?php include('inc/footer.php'); ?>