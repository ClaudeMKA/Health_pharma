<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');
//debug($_SESSION);
// request

$sql = 'SELECT * FROM avis ORDER BY created_at DESC ';
$query = $pdo->prepare($sql);
$query->execute();
$avis = $query->fetchAll();

include ('inc/header.php'); ?>
    <section id="intro">
        <div class="container1">
            <div class="text_intro">
                <p>Carnet personnel de <span>vaccination en ligne</span>
                </p>
            </div>
            <div class="txt">
                <div><p><i class="fa-solid fa-check"></i>Quels vaccins avez-vous reçus ?</p></div>
                <div><p><i class="fa-solid fa-check"></i>Êtes-vous à jour sur vos vaccins ?</p></div>
            </div>
            <div class="bouton">
                <a href="#video">Voir la vidéo</a>
                <?php if(!isLogged()){
                    echo'<a href="inscription.php">Créer un compte</a>';
                }?>
            </div>
        </div>
    </section>

    <section id="video">
        <div class="wrap">
            <div class="container2">
                <div class="text">
                    <p>Pourquoi choisir Health Pharma ?</p>
                </div>
                <div class="video_pharma">
                    <div class="health">
                        <video src="asset/video/Health_Pharma_1.mp4" controls   ></video>
                        <div class="img_feminine">
                            <img src="asset/img/belle_femme.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="instruction">
        <div class="container3">
            <div class="bloc1">
                <div class="photo">
                    <img src="asset/img/header_profil.svg" alt="">
                </div>
                <div class="photo_txt">
                    <h1>1. Créez votre compte</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi distinctio enim, magni modi quibusdam? Assumenda consequatur cum iste ratione?</p>
                </div>
            </div>
            <div class="bloc2">
                <div class="photo">
                    <img src="asset/img/header_profil2.svg" alt="">
                </div>
                <div class="photo_txt">
                    <h1>2. Créez votre carnet</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi distinctio enim, magni modi quibusdam? Assumenda consequatur cum iste ratione?</p>
                </div>
            </div>
            <div class="bloc3">
                <div class="photo">
                    <img src="asset/img/header_profil3.svg" alt="">
                </div>
                <div class="photo_txt">
                    <h1>3. Personnalisez votre carnet</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi distinctio enim, magni modi quibusdam? Assumenda consequatur cum iste ratione?</p>
                </div>
            </div>
        </div>
    </section>

    <section id="avis">
        <div class="container4">
            <h2>Ils vous en parlent mieux que nous.</h2>
            <div class="boite">
           <?php foreach ($avis as $avi) { ?>
            <div class="avis_perso">
                <div class="avis_name">
                    <h3><?php echo $avi['nom']; ?> <?php echo $avi['prenom']; ?></h3>
                </div>
                <div class="avis_text">
                    <p><?php echo $avi['message']; ?></p>
                </div>
                <div class="mini_logo">
                    <img src="asset/img/header_logo.svg" alt="">
                </div>
            </div>
           <?php } ?>
            </div><br>
            <p>Une question ? un problème ?</p>
            <div class="button">
                <a href="contact.php">Contactez-nous</a>
            </div>
        </div>
    </section>

<?php include ('inc/footer.php');

