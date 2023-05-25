<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

if(!isAdmin()){
    header('Location: ../404.php');
}

$sql = 'SELECT * FROM user WHERE role = "abonne" LIMIT 6 ';
$query = $pdo->prepare($sql);
$query->execute();
$abonne = $query->fetchAll();

$sql = 'SELECT * FROM user WHERE role = "admin" LIMIT 6 ';
$query = $pdo->prepare($sql);
$query->execute();
$admin = $query->fetchAll();

$sql = $sql = 'SELECT * FROM vaccin LIMIT 10 ';
$query = $pdo->prepare($sql);
$query->execute();
$vaccin = $query->fetchAll();

$sql = $sql = 'SELECT * FROM avis LIMIT 8 ';
$query = $pdo->prepare($sql);
$query->execute();
$avi = $query->fetchAll();


include ('inc/header.php'); ?>
    <!-- ========================= Main ==================== -->
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
        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers"><?php  echo isCountuser()?></div>
                    <div class="cardName">le nombre d'utilisateur inscrit</div>
                </div>


                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">80</div>
                    <div class="cardName">Nombres de rappels effectués </div>
                </div>

                <div class="iconBx">
                    <ion-icon name="time"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"><?php  echo isCountavis()?></div>
                    <div class="cardName">Avis</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">20</div>
                    <div class="cardName">Nombre de carnet crée</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="book"></ion-icon>
                </div>
            </div>
        </div>
        <!-- ================ users Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Gestions des utilisateurs</h2>
                    <a href="utilisateur.php" class="btn">Voir plus</a>
                </div>

                <table>
                    <thead>
                    <tr>
                        <td>E-mail</td>
                        <td>Name</td>
                        <td>Date de création du compte :</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($abonne as $abonnes) { ?>
                        <tr>
                            <td><?php echo $abonnes['email']; ?></td>
                            <td><?php echo $abonnes['prenom']; ?></td>
                            <td><?php echo $abonnes['created_at']; ?></td>
                        </tr>
                    <?php } ?>




                    </tbody>
                </table>
            </div>
            <!-- ================= New Customers ================ -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Les administrateurs</h2>
                    <a href="administrateur.php" class="btn">Voir  plus</a>
                </div>
                <!-- faire un foreach pour affichez les utilisateurs -->
                <table>
                    <?php foreach ($admin as $admins) { ?>
                        <tr>
                            <td><ion-icon name="person-circle-outline"></ion-icon>
                                <?php echo $admins['prenom']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <!-- ================= Gestion des vacins ================ -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Gestion des vaccins</h2>
                    <a href="vaccin.php" class="btn">Voir plus</a>
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
                        <?php } ?>

                    </tr>


                    </tbody>
                </table>
            </div>
            <!-- Avis -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Les avis</h2>
                    <a href="avis.php" class="btn">Voir plus </a>
                </div>
                <!-- faire un foreach pour les avis -->
                <table>
                    <?php foreach ($avi as $avis) { ?>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="asset/img/header_profil.png" alt=""></div>
                            </td>
                            <td>
                                <h4> <?php echo $avis['nom']; ?> <br> <span><?php echo $avis['prenom']; ?></span></h4>
                            </td>
                        </tr>
                    <?php } ?>


                </table>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div>
<?php include ('inc/footer.php');