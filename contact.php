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
    $email = cleanXss('email');
    $message = cleanXss('message');
    // Validation
    // nom min 3, max 100, renseigné.
    $errors = validationText($errors, $nom, 'nom',3, 100);

    // email => email valid et renseigné,
    $errors = validationEmail($errors, $email, 'email');

    // message min 5, max 2000, renseigné,
    $errors = ValidationText($errors, $message,'message',5, 2000);

    if(count($errors) == 0) {
        // INSERT INTO
        $sqlAdd = "INSERT INTO contact (nom, email, message, created_at) VALUES (:nom, :email, :message,NOW())";
        $query = $pdo->prepare($sqlAdd);
        $query -> bindValue('nom',$nom,PDO::PARAM_STR);
        $query -> bindValue('email',$email, PDO::PARAM_STR);
        $query -> bindValue('message',$message,PDO::PARAM_STR);
        $query->execute();
        $success = true;
    }

}

include ('inc/header.php'); ?>

<?php if($success) {
    echo '<p class = "message">FORMULAIRE TRANSMIS</p>';

}else { ?>
    <section id="contact">
        <div class="contactez_nous">
            <h2> Contactez-nous</h2>
        </div>
    </section>

    <section id="page_contact">
        <div class="bloc_contact">
            <div class="right_contact">
                <form action="" method="post" novalidate >
                    <div class="l1">
                        <label for="nom">Votre nom</label>
                          <input type="text"  id="nom" name="nom" placeholder="ex : nom" value="<?php getPostValue('nom'); ?>">
                          <span class="error"><?php viewError($errors, 'nom'); ?></span>
                    </div>

                    <div class="l1">
                        <label for="email">Votre email</label>
                        <input type="email"  id="email" name="email" placeholder="ex : nom@domain.com" value="<?php getPostValue('email'); ?>">
                        <span class="error"><?php viewError($errors, 'email'); ?></span>

                    </div>

                    <div class="l1">
                        <label for="message">Votre message</label>
                        <textarea name="message" id="message" cols="30" rows="10" ><?php getPostValue('message'); ?></textarea>
                        <span class="error"><?php viewError($errors, 'message'); ?></span>

                    </div>

                    <div class="submit">
                        <input type="submit" name="submitted" value="Envoyer">
                    </div>
                    <div class="img_contact">
                        <img src="asset/img/contact_3.png" alt="">
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>
<?php include('inc/footer.php');