

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Health pharma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
<header id="header">
    <div class="wrap">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="asset/img/Logo.png" alt="logo d'un coeur ainsi"></a>
            </div>
            <nav>
                <ul>
                    <li><a  class="active" href="index.php">Acceuil</a></li>
                    <li><a  href="contact.php">Contactez-nous</a></li>

                    <?php if(isAdmin()) {  ?>
                        <li><a href="admin/index.php">Admin</a></li>
                    <?php } ?>

                    <?php if(!isLogged()) { ?>
                        <li class="inscription">
                                <a class="connect" href="page_connexion.php">Se connecter</a>
                        </li>
                    <?php } else { ?>
                        <li class="inscription">
                                <a class="connect" href="espace_user.php">Mon compte</a>
                        </li>
                        <li class="inscription">
                                <a class="connect" href="logout.php">Déconnexion</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</header>



