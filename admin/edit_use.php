<?php
require('inc/pdo.php');
require('inc/fonction.php');
session_start();
$errors = array();
$success = false;
//
if(!isAdmin()){
    header('Location: ../404.php');
}



if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $admin = getAdminById($id);
    if(empty($admin)) {
        redirectNotFound();
    }
} else {
    redirectNotFound();
}

debug($admin);


if (!empty($_POST['submitted'])) {
    // Failles XSS
    $nom = cleanXss('nom');
    $prenom = cleanXss('prenom');
    // Validation des champs
    // email validation unique




    // Validation Prenom
    $errors = validationText($errors, $prenom, 'prenom', 3, 140);

    // Validation nom unique
    $errors = validationText($errors, $nom, 'nom', 3, 140);
    if (empty($errors['nom'])) {
        $sql = "SELECT nom FROM user WHERE nom = :nom";
        $query = $pdo->prepare($sql);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->execute();
        $verifnom = $query->fetch();
        if (!empty($verifnom)) {
            $errors['nom'] = 'nom déjà pris';
        }
    }
    if (count($errors) == 0) {
        // UPDATE
        updateAdmin($id, $nom, $prenom,);
        $success = true;
        header('Location: utilisateur.php');
    }
}

include ('inc/header.php'); ?>
<section id="admin">
    <div class="main">
        <div class="bloc">
            <div class="texte">
                <h2> Bonjour !</h2>
                <p>Modifier<span class="textevert"> Administrateur</span></p>
            </div>
            <div class="formulaire">
                <form action="" method="post" novalidate >

                    <label for="prenom"></label>
                    <input  type="text" id="prenom" name="prenom" placeholder="prenom" value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom'];} else {echo $admin['prenom'];} ?>">
                    <span class="error"><?php if(!empty($errors['prenom'])) {echo $errors['prenom'];} ?></span>

                    <label for="nom"></label>
                    <input  type="text" id="nom" name="nom" placeholder="nom" value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom'];} else {echo $admin['nom'];} ?>">
                    <span class="error"><?php if(!empty($errors['nom'])) {echo $errors['nom'];} ?></span>

                    <input type="submit" name="submitted" value="Modifier">
                </form>
            </div>
            <p><a href="utilisateur.php">Retour</a></p>
        </div>
    </div>
</section>

<?php  include ('inc/footer.php'); ?>
