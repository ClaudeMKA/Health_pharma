<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
// request
$sql = 'SELECT * FROM user WHERE role = "admin" ';
$query = $pdo->prepare($sql);
$query->execute();
$admin = $query->fetchAll();

if(!isAdmin()){
    header('Location: ../404.php');
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
                        <h2>Gestion des administrateurs</h2>
                        <a href="new_admin.php" class="btn">Créer un Admin</a>

                    </div>

                    <table>
                        <thead>
                        <tr>
                            <td>email</td>
                            <td>prenom </td>
                            <td>crée le :</td>
                            <td>modifié le :</td>

                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($admin as $admins) { ?>
                            <tr>
                                <td><?php echo $admins['email']; ?></td>
                                <td><?php echo $admins['prenom']; ?></td>
                                <td><?php echo $admins['modified_at']; ?></td>
                                <td><?php echo $admins['created_at']; ?></td>
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
