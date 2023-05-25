<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');


$errors = array();
$success = false;
// If form soumis
if(!empty($_POST['submitted'])) {
    // Faille XSS
    $nom = cleanXss('nom');
    $prenom = cleanXss('prenom');
    $message = cleanXss('message');
    // Validation
    // nom min 3, max 100, renseigné.
    $errors = validationText($errors, $prenom, 'prenom',3, 100);

    // prenom min 3, max 100, renseigné.
    $errors = validationText($errors, $nom, 'nom',3, 100);


    // message min 5, max 2000, renseigné,
    $errors = ValidationText($errors, $message,'message',5, 2000);

    if(count($errors) == 0) {
        // INSERT INTO
        $sqlAdd = "INSERT INTO avis (nom, prenom, message, created_at) VALUES (:nom, :prenom, :message,NOW())";
        $query = $pdo->prepare($sqlAdd);
        $query -> bindValue('nom',$nom,PDO::PARAM_STR);
        $query -> bindValue('prenom',$prenom, PDO::PARAM_STR);
        $query -> bindValue('message',$message,PDO::PARAM_STR);
        $query->execute();
        $success = true;
    }

}

include ('inc/header.php'); ?>

<?php if($success) {
    echo '  <section id="avis_fond">
<p class = "message">AVIS TRANSMIS</p>
</section>';
}else { ?>
    <section id="avis_fond">
        <div class="bloc">
            <div class="texte">
                <h2> Bonjour !</h2>
                <p>Laissez-nous votre <span class="textevert">Avis.</span></p>
            </div>
            <div class="formulaire avis">
                <form action=""  class="wrapform" method="post" novalidate>

                    <label for="nom"></label>
                    <input style=" font-weight: bold" type="text" id="nom" name="nom" placeholder="nom"  value="<?php getPostValue('nom'); ?>">
                    <span class="error"><?php viewError($errors, 'nom'); ?></span>

                    <label for="prenom"></label>
                    <input style=" font-weight: bold" type="text" id="prenom" name="prenom"  placeholder="Prenom" value="<?php getPostValue('prenom'); ?>">
                    <span class="error"><?php viewError($errors, 'prenom'); ?></span>

                    <label for="message"></label>
                    <textarea name="message" id="message" cols="30" rows="10" ><?php getPostValue('message'); ?></textarea>
                    <span class="error"><?php viewError($errors, 'message'); ?></span>

                    <input type="submit" name="submitted" value="Envoyer">
                </form>
            </div>
            <p><a href="index.php">Retour</a></p>
        </div>
    </section>
<?php } ?>
<?php include('inc/footer.php');