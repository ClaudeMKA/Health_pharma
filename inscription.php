<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');

$errors = [];

if( isLogged() ) {
    header('Location: index.php');
}

// If form soumis
if(!empty($_POST['submitted'])) {
    // Faille XSS
    $prenom = cleanXss('prenom');
    $nom = cleanXss('nom');
    $email = cleanXss('email');
    $password = cleanXss('password');
    $password2 = cleanXss('password2');

    //  nom 3, max 100, renseigné.
    $errors = validationText($errors, $nom, 'nom',3, 100);
    if(empty($errors['prenom'])) {
        $sql = "SELECT nom FROM user WHERE nom = :nom";
        $query = $pdo->prepare($sql);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            $errors['nom'] = 'nom déjà pris';
        }
    }

    //  prenom 3, max 100, renseigné.
    $errors = validationText($errors, $prenom, 'prenom',3, 100);
    // pseudo unique.
    if(empty($errors['prenom'])) {
        $sql = "SELECT prenom FROM user WHERE prenom = :prenom";
        $query = $pdo->prepare($sql);
        $query->bindValue('prenom', $prenom, PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            $errors['prenom'] = 'prenom déjà pris';
        }
    }
    // email => email valid et renseigné,
    $errors = validationEmail($errors, $email,'email');
    // email unique
    if(empty($errors['email'])) {
        $sql = "SELECT id  FROM user WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue('email', $email, PDO::PARAM_STR);
        $query->execute();
        $verifEmail = $query->fetch();
        if(!empty($verifEmail)) {
            $errors['email'] = 'Email déjà pris';
        }
    }

    // password // => renseigné, identiques, 6 caractères au minimum
    if(!empty($password) && !empty($password2)) {
        if($password != $password2) {
            $errors['password'] = 'Vos mots de passe sont différents';
        } elseif(mb_strlen($password) < 6) {
            $errors['password'] = 'Votre mot de passe est trop court(min 6)';
        }
    } else {
        $errors['password'] = 'Veuillez renseigner les mots de passe';
    }

    if(count($errors) == 0) {
        // INSERT INTO
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'abonne';
        $token = generateRandomString(80);
        $sql = "INSERT INTO user (prenom, email,password,created_at,role,token) VALUES (:prenom, :em,:pass, NOW(), '$role', '$token')";
        $query = $pdo->prepare($sql);
        $query->bindValue('prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue('em', $email, PDO::PARAM_STR);
        $query->bindValue('pass', $hashPassword, PDO::PARAM_STR);
        $query->execute();
        header('Location: page_connexion.php');
    }

}

include ('inc/header.php'); ?>
    <section id="register">
        <div class="bloc">
            <div class="texte">
                <h2> Bonjour !</h2>
                <p>Inscrivez-vous sur <span class="textevert">health pharma</span></p>
            </div>
            <div class="formulaire">
                <form action=""  class="wrapform" method="post" novalidate>

                    <label for="nom"></label>
                    <input style=" font-weight: bold" type="text" id="nom" name="nom"  placeholder="nom" value="<?php getPostValue('nom'); ?>">
                    <span class="error"><?php viewError($errors, 'nom'); ?></span>

                    <label for="prenom"></label>
                    <input style="font-weight: bold" type="text" id="prenom" name="prenom"  placeholder=" Prenom" value="<?php getPostValue('prenom'); ?>">
                    <span class="error"><?php viewError($errors, 'prenom'); ?></span>

                    <label for="email"></label>
                    <input style="font-weight: bold" type="email" id="email" name="email" placeholder=" E-mail"  value="<?php getPostValue('email'); ?>">
                    <span class="error"><?php viewError($errors, 'email'); ?></span>

                    <label for="password"></label>
                    <input style=" font-weight: bold" type="password" id="password" name="password" placeholder="Mot de passe"  value="<?php getPostValue('password'); ?>">
                    <span class="error"><?php viewError($errors, 'password'); ?></span>

                    <label for="password2"></label>
                    <input style=" font-weight: bold" type="password" id="password2" name="password2" placeholder=" Confirmez votre mot de passe" value="">

                    <input type="submit" name="submitted" value="S'incrire">
                </form>
            </div>
            <p><a href="page_connexion.php">Retour</a></p>
        </div>
    </section>
<?php include ('inc/footer.php');