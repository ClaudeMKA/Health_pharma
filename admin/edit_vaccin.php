<?php
require('inc/pdo.php');
require('inc/fonction.php');
session_start();
if(!isAdmin()){
    header('Location: ../404.php');
}
$errors = array();
$success = false;
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $vaccin = getVaccinById($id);
    if(empty($vaccin)) {
        die('404');
    }
} else {
    die('404');
}

if (!empty($_POST['submitted'])) {
    // Failles XSS
    $nom_vaccin = cleanXss('nom_vaccin');
    $maladie = cleanXss('maladie');

    // Validation des champs
    // email validation unique
    // Validation maladie
    $errors = validationText($errors, $nom_vaccin, 'nom_vaccin', 2, 100);

    // Validation nom
    $errors = validationText($errors, $maladie, 'maladie', 2, 100);

    if (count($errors) == 0){
        updateVaccin($id, $nom_vaccin, $maladie);
        $success = true;
        header('Location: vaccin.php');
    }
}


include ('inc/header.php'); ?>

<section id="admin">
    <div class="main">
        <div class="bloc">
            <div class="texte">
                <h2> Bonjour !</h2>
                <p>Modifier un <span class="textevert"> Vaccin</span></p>
            </div>
            <div class="formulaire">
                <form action="" method="post" novalidate >
                    <label for="nom_vaccin"></label>
                    <input  type="text" id="nom_vaccin" name="nom_vaccin" placeholder="nom" value="<?php if(!empty($_POST['nom_vaccin'])) { echo $_POST['nom_vaccin'];} else {echo $vaccin['title'];} ?>">
                    <span class="error"><?php if(!empty($errors['title'])) {echo $errors['title'];} ?></span>

                    <label for="maladie"></label>
                    <input  type="text" id="maladie" name="maladie" placeholder="maladie" value="<?php if(!empty($_POST['description'])) { echo $_POST['description'];} else {echo $vaccin['description'];} ?>">
                    <span class="error"><?php if(!empty($errors['maladie'])) {echo $errors['maladie'];} ?></span>

                    <input type="submit" name="submitted" value="Modifier">
                </form>
            </div>
            <p><a href="vaccin.php">Retour</a></p>
        </div>
    </div>
</section>

<?php  include ('inc/footer.php'); ?>

