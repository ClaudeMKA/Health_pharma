<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('inc/validation.php');
// request

// Supression
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $user = getIdByUser($id);
    if(empty($user)) {
        die('404');
    } else {
        $sql = "DELETE FROM user WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue('id',$id, PDO::PARAM_INT);
        $query->execute();
        header('Location: logout.php');
    }
}

include ('inc/header.php'); ?>
<section id="register">
    <div class="delete">
    <div class="bloc">
        <div class="texte">

            <h2> <?php echo $_SESSION['user']['prenom'] ?> </h2>
            <p>Êtes-vous  sûr de supprimer votre <span class="textevert"> compte ? </span></p>
        </div>
          <div class="suppression">

                  <div class="non">
                <a href="carnet.php"> Non </a>
                </div>
                 <div class="non">
                 <a href="delete.php?id=<?php echo  $_SESSION['user']['id']; ?>"> Oui</a>
              </div>
          </div>





        </div>
    </div>
    </div>
</section>
<?php include ('inc/footer.php');

