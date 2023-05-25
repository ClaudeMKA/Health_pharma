<?php
session_start();
require ('inc/fonction.php');
require ('inc/pdo.php');
require ('inc/validation.php');

$errors = array();
$success = false;
$valid = false;


if(isLogged()){
    header('Location: 404.php');
}


if (isset($_SESSION['id'])){
    header('Location: page_connexion.php');
    exit;
}

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    if (isset($_POST['oublie'])){
        $email = htmlentities(strtolower(trim($email))); // On récupère le mail afin d envoyer le mail pour la récupèration du mot de passe
        $email = cleanXss('email'); // Pour la protection
        $errors = ValidationEmail($errors, $email, 'email', 5, 500); // Validation des champs d'erreur
        // Si le mail est vide alors on ne traite pas
        if(empty($email)){
            $valid = false;
            $er_email = "Il faut mettre un email";
        }
        if($valid){
            $sql = "SELECT prenom, email, password, n_password FROM user WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->bindValue('email', $email, PDO::PARAM_STR);
            $query->execute();
            $verification_email = $query->fetch();

            if(isset($verification_email['email'])){
                if($verification_email['n_password'] == 0){
                    $objet = 'Nouveau mot de passe';
                    $to = $verification_email['email'];

                    //===== Création du header du mail.
                    $header = "From: NOM_DE_LA_PERSONNE <no-reply@test.com> \n";
                    $header .= "Reply-To: ".$to."\n";
                    $header .= "MIME-version: 1.0\n";
                    $header .= "Content-type: text/html; charset=utf-8\n";
                    $header .= "Content-Transfer-Encoding: 8bit";
                }
            }
        }
        //===== Envoi du mail
    }elseif (isset($_POST['mdp_oublie'])){
        $email = cleanXss('email_mdp');
        $errors = ValidationEmail($errors, $email, 'email', 5, 500);
        $password = cleanXss('password');
        echo $password;
        echo $email;
        if (count($errors) == 0) {
            $new_pass_crypt = crypt($password, '$2y$10$gqVpY5hXMuGW6nThKRe5HudT8HuTRc2tqytGMTMiuY2...');
            echo $new_pass_crypt;
            /// UPDATE
            $sql = "UPDATE user SET password = :password, modified_at = NOW(),n_password = 1 WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->bindValue('password', $new_pass_crypt, PDO::PARAM_STR);
            $query->bindValue('email', $email, PDO::PARAM_STR);
            $query->execute();
            $success = true;
        }
    }
}

include ('inc/header.php');
if($valid == true) {
    echo "<section id='register'>
                                    <div class='bloc'>
                                        <div class='texte'>
                                            <p>Bonjour Mr, Mme " . $verification_email['prenom'] . "</p><br>
                                            </div>
                                            <div class='formulaire'>
                                            <form action='' method='post' class='wrapform' novalidate>
                                            <label for='password' id='password'></label>
                                            <input style='font-weight: bold;' type='password' value='' name='password' placeholder='nouveau mot de passe'>
                                             <input type='hidden' id='mdp_oublie' name='mdp_oublie' value=''> <br>
                                              <label for='email_mdp' id='email_mdp'></label> 
                                             <input  style='font-weight: bold;' type='text' id='email_mdp' name='email_mdp' value='' placeholder='email'>
                                             
                                            
                                            <input type='submit' name='submitted' value='Envoyer'>
                                            </form>                                           
                                        </div>
                                        </div>
                                    </div>                              
                                </section>";
} else {?>
    <section id="register">
        <div class="bloc">
            <div class="texte">
                <p>Veuillez saisir votre email</p>
            </div>
            <div class="formulaire">
                <form action="" method="post" class="wrapform" novalidate>
                    <?php
                    if (isset($er_email)){?>
                        <div><?= $er_email ?></div>
                    <?php } ?>
                    <input type="email" placeholder="E-mail" name="email" value="<?php if(isset($email)){ echo $email; }?>" required>
                    <input type="submit" name="oublie" value="Envoyer">
                </form>
            </div>
        </div>
    </section>
   <?php } ?>
<?php include ('inc/footer.php');
