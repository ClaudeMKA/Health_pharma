<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
$errors = array();
$success = false;

if(!isAdmin()){
    header('Location: ../404.php');
}

if (!empty($_POST['submitted'])) {
// Failles XSS
    $nom_vaccin = cleanXss('nom_vaccin');
    $maladie = cleanXss('maladie');

// Validation des champs

    $errors = validationText($errors, $nom_vaccin, 'nom_vaccin', 2, 100);

// Validation nom
    $errors = validationText($errors, $maladie, 'maladie', 2, 100);

    if (count($errors) == 0) {
        $sql = "INSERT INTO vaccin (nom_vaccin , maladie)
                VALUES ( :nom_vaccin , :maladie)";
        $query = $pdo->prepare($sql);
        $query->bindValue('nom_vaccin', $nom_vaccin, PDO::PARAM_STR);
        $query->bindValue('maladie', $maladie, PDO::PARAM_STR);
        $query->execute();
        header('Location: vaccin.php');

    }

}


include ('inc/header.php'); ?>
<section id="admin">
    <div class="bloc">
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            <div class="texte">
                <h2> Bonjour !</h2>
                <p>Modifier un <span class="textevert"> Utilisateur</span></p>
            </div>
            <div class="formulaire">
                <form action="" method="post" novalidate >

                    <label for="nom_vaccin"></label>
                    <input  type="nom_vaccin" id="nom_vaccin" name="nom_vaccin" placeholder="Nom du vaccin " value="">
                    <span class="error"><?php getPostValue('nom_vaccin'); ?></span>

                    <label for="maladie"></label>
                    <input  type="maladie" id="maladie" name="maladie" placeholder="maladie" value="">
                    <span class="error"><?php getPostValue('maladie'); ?></span>

                    <input type="submit" name="submitted" value="Ajouter">
                </form>
            </div>
            <p><a href="vaccin.php">Retour</a></p>
        </div>
    </div>
</section>
<?php  include ('inc/footer.php'); ?>
