<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');

if(!isAdmin()){
    header('Location: ../404.php');
}

// request
$sql = 'SELECT * FROM user WHERE role = "abonne" ';
$query = $pdo->prepare($sql);
$query->execute();
$users = $query->fetchAll();


// Supression
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // debug($ville);
    if(empty($users)) {
        die('404');
    } else {
        $sql = "DELETE FROM user WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue('id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: utilisateur.php');
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
                        <h2>Gestion des utilisateurs</h2>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <td>email</td>
                            <td>prenom </td>
                            <td>nom</td>
                            <td> Date création de compte</td>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['prenom']; ?></td>
                                <td><?php echo $user['nom']; ?></td>
                                <td><?php echo $user['created_at']; ?></td>
                                <td><span class="status return"> <a href="utilisateur.php?id=--><?php echo $user['id']; ?>">Supprimer</a></span></td>
                                <td><span class="status inProgress"><a href="edit_use.php?id=<?php echo $user['id']; ?>">Modifiez</a></span></td>
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
