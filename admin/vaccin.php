<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');

if(!isAdmin()){
    header('Location: ../404.php');
}

// request
$sql = 'SELECT * FROM vaccin  ';
$query = $pdo->prepare($sql);
$query->execute();
$vaccin = $query->fetchAll();

// suppresion
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // debug($ville);
    if(empty($vaccin)) {
        die('404');
    } else {
        $sql = "DELETE FROM vaccin WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue('id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: vaccin.php');
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
                        <h2>Gestion des vaccins </h2>
                        <a href="new_vaccin.php" class="btn">Ajouter un vaccin </a>
                    </div>

                    <table>
                        <thead>
                        <tr>
                            <td>Nom du vaccin</td>
                            <td>Maladie</td>

                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($vaccin as $vaccins) { ?>
                            <tr>
                                <td><?php echo $vaccins['title']; ?></td>
                                <td><?php echo $vaccins['description']; ?></td>

                                <td>
                                    <span class="status inProgress"><a href="edit_vaccin.php?id=<?php echo $vaccins['id']?>">Modifier</a></span>
                                    <span class="status return"> <a href="vaccin.php?id=<?php echo $vaccins['id']?>">Supprimer</a></span>
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
<?php include ('inc/footer.php'); ?>

