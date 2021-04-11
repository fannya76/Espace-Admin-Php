<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>

<body>
    <header>
        <a href="gestion_users_sql.php">Gestion Utilisateurs</a>
        <p class="title">TABLEAU DE BORD</p>
        <a href="index.php?logout">Se déconnecter</a>
    </header>


    <p>Bienvenue <?php echo ($_SESSION['user']['firstname']). ' ' .($_SESSION['user']['lastname']) ; ?></p>
    <hr>
</body>

</html>