<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');

if(isAdmin()){
    header('Location: admin/index.php');
}elseif(isLogged()){
    header('Location: espace_user.php');
}

$errors = [];


if (!empty($_POST['submitted'])) {
    $email = cleanXss('email');
    $password = cleanXss('password');
    //vérification si un user exiqte avec ce mail ou ce pseudo => SELECT fetch =>
    $sql ="SELECT * FROM user WHERE  email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue('email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    /*debug($_SESSION);*/

    if (!empty($user)) {
        if (password_verify($password, $user['password']
        )){
            // CONNEXION  =>  $_SESSION
            $_SESSION['user'] = array(
                'id' => $user['id'],
               'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role'],
                'ip' => $_SERVER['REMOTE_ADDR']);
            if(isAdmin()){
                header('Location: admin/index.php');
            }elseif (isLogged()){
                header('Location: espace_user.php');
            }
        } else {
            $errors['email'] = "MOT DE PASSE OU ADRESSE INVALIDE";
        }
    } else {
        $errors['email'] = "MOT DE PASSE OU ADRESSE INVALIDE";
    }
    debug($_SESSION);
}



include ('inc/header.php'); ?>
    <section id="register">
        <div class="bloc">
            <div class="texte">
                <h2> Bonjour !</h2>
                <p>Connectez-vous à votre <span class="textevert">compte</span></p>
            </div>
            <div class="formulaire">
                <form action="" method="post" novalidate >
                    <input style= "font-weight: bold" type="email" id="email" name="email" placeholder="E-mail" value="<?php getPostValue('email'); ?>">
                    <span class="error"><?php viewError($errors, 'email'); ?></span>

                    <input style=" font-weight: bold" type="password" id="password" name="password" placeholder="mot de passe" value="">

                    <span > <a class="mdp" href="mot_de_passe.php">Mot de passe oublié ?</a> </span>
                    <input type="submit" name="submitted" value="Se connecter">
                </form>
            </div>
            <p>Vous n'avez pas de compte ?</p>
            <p><a href="inscription.php">S'inscire</a></p>
        </div>
    </section>
<?php include ('inc/footer.php');
