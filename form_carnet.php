<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');



$errors = [];
// empecher les utilisateur de venir sur cette page

if (!isLogged()){
    die('404');
}

global $pdo;
$sql = "SELECT * FROM vaccin";
$query = $pdo->prepare($sql);
$query->execute();
$vaccins = $query->fetchAll();

$id_user =  $_SESSION['user']['id'];

// if form soumis
if(!empty($_POST['submitted'])) {
// Faille xss
    $id_vaccin = cleanXss('id_vaccin');
    $date = cleanXss('date');

    if (!validateDate($_POST['date'])) {
      $errors['date'] = 'date non valide';
    }

    // validation que le vaccins existe dans la bdd
    $sql ="SELECT * FROM vaccin WHERE  id = :id_vaccin";
    $query = $pdo->prepare($sql);
    $query->bindValue('id_vaccin', $id_vaccin, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch();

    // insert
    if (count($errors) == 0) {
        /// INSERT INTO
       $sql = "INSERT INTO `user-vaccin` (id_user,id_vaccin, date , created_at)
                VALUES (:id_user, :id_vaccin, :date, NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue('id_user', $id_user);
        $query->bindValue('id_vaccin', $id_vaccin);
        $query->bindValue('date', $date);
        $query->execute();
        $success = true;
        header('Location: carnet.php');
    }
}


include ('inc/header.php'); ?>
<section id="carnet1">
    <div class="bloc">
        <div class="texte">
            <p>Ajouter un vaccin s'il vous plait!<br>
                <span><?php echo $_SESSION['user']['prenom'];?></span></p>
        </div>
        <div class="formulaire">
            <form action=""  method="post" novalidate>
                <div class="carn1">
                    <label for="id_vaccin">nom du vaccin</label>
                    <select name="id_vaccin" id="id_vaccin">
                        <?php foreach ($vaccins as $vaccin) { ?>
                            <option value="<?php echo  $vaccin['id']; ?>">
                                <?php echo $vaccin['title']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="carn1">
                    <label for="date">Date de prise</label>
                    <input id="date" name="date" type="date" value="<?php getPostValue('date'); ?>">
                    <span class="error"><?php viewError($errors, 'date'); ?></span>
                </div>

                <input class="bouton" type="submit" name="submitted" value="Ajouter">
            </form>
        </div>
    </div>
</section>
<?php  include ('inc/footer.php'); ?>
