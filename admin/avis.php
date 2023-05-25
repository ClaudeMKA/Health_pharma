<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
$sql = 'SELECT * FROM avis ';
$query = $pdo->prepare($sql);
$query->execute();
$avi = $query->fetchAll();
if(!isAdmin()){
    header('Location: ../404.php');
}
// Supression
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // debug($ville);
    if(empty($avi)) {
        die('404');
    } else {
        $sql = "DELETE FROM avis WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue('id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: avis.php');
    }
}
include ('inc/header.php'); ?>
    <section class="admin">
        <div class="bloc">
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>

                    <div class="search">
                        <label>
                            <input type="text" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>

                        </label>
                    </div>

                  <div class="user">
                        <img src="asset/img/header_profil.png" alt="">
                        <p style="color: red;font-weight: bold"><?php echo $_SESSION['user']['prenom'] ?></p>
                    </div>
                </div>
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Les Avis</h2>
                        </div>

                        <table>
                            <thead>
                            <tr>
                                <td>nom </td>
                                <td>prenom</td>
                                <td>message :</td>
                                <td>crée le :</td>

                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($avi as $avis) { ?>
                                <tr>
                                    <td><?php echo $avis['prenom']; ?></td>
                                    <td><?php echo $avis['nom']; ?></td>
                                    <td><?php echo $avis['message']; ?></td>
                                    <td><?php echo $avis['created_at']; ?></td>
                                    <td>
                                        <span class="status return"> <a href="avis.php?id=<?php echo $avis['id']; ?>">Supprimer</a></span>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include ('inc/footer.php');