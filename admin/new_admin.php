<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');

if(!isAdmin()){
    header('Location: ../404.php');
}

$errors = array();
$success = false;
if(!empty($_POST['submitted'])) {
// Faille xss
    $email = cleanXss('email');
    $prenom = cleanXss('prenom');
    $nom = cleanXss('nom');
    $password = cleanXss('password');
    $password2 = cleanXss('password2');
    // Validations des champs
    // email validation unique
    $errors = ValidationEmail($errors,$email,'email',2,50);
    if(empty($errors['email'])) {
        $sql = "SELECT id FROM user WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue('email', $email, PDO::PARAM_STR);
        $query->execute();
        $verifEmail = $query->fetch();
        if(!empty($verifEmail)) {
            $errors['email'] = 'Email déjà pris';
        }
    }
    // Validation Pseudo
    $errors = validationText($errors, $prenom, 'prenom', 3, 140);


    // Validation nom unique
    $errors = validationText($errors, $nom, 'nom', 3, 140);
    if(empty($errors['nom'])) {
        $sql = "SELECT nom FROM user WHERE nom = :nom";
        $query = $pdo->prepare($sql);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->execute();
        $verifnom = $query->fetch();
        if(!empty($verifnom)) {
            $errors['nom'] = 'nom déjà pris';
        }
    }
    // password // => renseigné, identiques, 6 caractères au minimum
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
        $role = 'admin';
        $token = generateRandomString(80);
        $sql = "INSERT INTO user (prenom,email,password,nom,created_at,role,token)
                VALUES (:prenom,:email,:password,:nom, NOW(),  '$role', '$token')";
        $query = $pdo->prepare($sql);
        $query->bindValue('prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue('email', $email, PDO::PARAM_STR);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->bindValue('password', $hashPassword, PDO::PARAM_STR);
        $query->execute();
        header('Location: administrateur.php');
    }

}

include('inc/header.php'); ?>
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
                    <p>Créer un <span class="textevert">Administrateur</span></p>
                </div>
                <div class="formulaire">
                    <form action="" method="post" novalidate >

                        <label for="email"></label>
                        <input  type="email" id="email" name="email" placeholder="E-mail"  value="<?php getPostValue('email'); ?>">
                        <span class="error"><?php viewError($errors, 'email'); ?></span>

                        <label for="prenom"></label>
                        <input  type="text" id="prenom" name="prenom" placeholder="prenom" value="<?php getPostValue('prenom'); ?>">
                        <span class="error"><?php viewError($errors, 'prenom'); ?></span>

                        <label for="nom"></label>
                        <input  type="text" id="nom" name="nom" placeholder="nom" value="<?php getPostValue('nom'); ?>">
                        <span class="error"><?php viewError($errors, 'nom'); ?></span>

                        <label for="password"></label>
                        <input  type="password" id="password" name="password" placeholder="Mot de passe">
                        <span class="error"><?php viewError($errors, 'password'); ?></span>

                        <label for="password"></label>
                        <input  type="password" id="password2" name="password2" placeholder="Confirmez votre mot de passe">
                        <span class="error"><?php viewError($errors, 'password2'); ?></span>


                        <input type="submit" name="submitted" value="Créer">
                    </form>
                </div>
                <p><a href="administrateur.php">Retour</a></p>
            </div>
        </div>
    </section>


<?php include ('inc/footer.php'); ?>

