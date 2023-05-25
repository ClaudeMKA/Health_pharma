<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');

if(!isAdmin()){
    header('Location: ../404.php');
}

$sql = 'SELECT * FROM contact ';
$query = $pdo->prepare($sql);
$query->execute();
$contact = $query->fetchAll();
// Supression

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // debug($ville);
    if(empty($avi)) {
        die('404');
    } else {
        $sql = "DELETE FROM contact WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue('id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: contact.php');
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
                            <input type="text" placeholder="recherche">
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
                            <h2>Contact</h2>
                        </div>

                        <table>
                            <thead>
                            <tr>
                                <td>nom :</td>
                                <td>email : </td>
                                <td>message :</td>

                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($contact as $contacts) { ?>
                                <tr>
                                    <td><?php echo $contacts['nom']; ?></td>
                                    <td><?php echo $contacts['email']; ?></td>
                                    <td><?php echo $contacts['message']; ?></td>
                                    <td>
                                        <span class="status return"> <a href="contact.php?id=<?php echo $contacts['id']; ?>">Supprimer</a></span>
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

