
<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');



if (!isLogged()){
    die('404');
}


global $pdo;
$sql = "SELECT * FROM vaccin";
$query = $pdo->prepare($sql);
$query->execute();
$vaccins = $query->fetchAll();

global $pdo;
$sql = "SELECT * FROM `user-vaccin`";
$query = $pdo->prepare($sql);
$query->execute();
$users = $query->fetchAll();


$sessionid = $_SESSION['user']['id'];

$sqlBase = "SELECT uv.*, u.email, v.title, v.description FROM `user-vaccin` uv
    INNER JOIN  user u
        ON uv.id_user =  u.id
    INNER JOIN vaccin v  ON uv.id_vaccin = v.id WHERE uv.id_user =:sessionid";
$query = $pdo->prepare($sqlBase);
$query->bindValue('sessionid', $sessionid, PDO::PARAM_STR);
$query->execute();
$mixte = $query->fetchAll();


include ('inc/header.php');?>
<section id="carnet">
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2> Carnet de vaccination les vaccin effectuer </h2>
                <div class="carnet_vaccin">
                    <a href="form_carnet.php" class="btn"> Ajouter un Vaccin </a>
                    <a href="delete.php" class="btn">Supprimer mon compte  </a>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <td>Nom du vaccin</td>
                    <td>Nom de la Maladie</td>
                    <td>Date prise </td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($mixte as $mixtes) { ?>
                <tr>
                    <td><?php echo $mixtes['title']; ?></td>
                    <td><?php echo $mixtes['description']; ?></td>
                    <td><?php echo $mixtes['date']; ?></td>
                    <?php } ?>
                </tr>
                </tbody>
            </table>
        </div>
</section>

<?php include ('inc/footer.php');

