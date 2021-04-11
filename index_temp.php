<?php

require 'db_connect.php';

$message = "";

session_start();

if (isset($_GET['logout']))
    session_destroy();

if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['submit'])) // si un formulaire est envoyé (bouton submit cliqué) ...évite d'avoir les messages d'erreurs au 1er chargement de la page
{

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message = 'Veuillez entrer vos identifiants';
    } else {
        $email_input = htmlspecialchars(($_POST['email']));

        $mdp_input = htmlspecialchars(($_POST['password']));

        $query_user = mysqli_query($con, "SELECT * FROM users WHERE email = '$email_input'");

        // on récupère une seule ligne avec fetch array, on crée un tab associatif du user
        $user_array = mysqli_fetch_array($query_user, MYSQLI_ASSOC);

        if (password_verify($mdp_input, $user_array['password'])) {
            $_SESSION['user'] = $user_array;
            header('Location: dashboard.php');
            exit;
        } else {
            $message = 'Le mot de passe est incorrect';
        }

        if (empty($message)) {
            $message = 'Cet email est invalide';
        }
    }
}

mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>CPanel</title>
</head>

<body>

    <p class="title">ESPACE ADMINISTRATION</p>

    <div id="box_form">
        <form id="login" action="" method="POST">

            <label for="email">Votre Email</label>
            <input type="email" name="email" id="email" class="champs">

            <label for="mdp">Votre Mot de Passe</label>
            <input type="text" name="password" id="mdp" class="champs">


            <input type="submit" value="Envoyer" name="submit">
            <hr>
            <p class="erreur"><?= $message ?></p>

        </form>
    </div>

</body>

</html>