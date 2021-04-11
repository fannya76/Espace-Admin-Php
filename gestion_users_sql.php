<?php
// on appelle le fichier de connexion à la bdd
require 'db_connect.php';

// démarrage de la session
session_start();
// vérifie si connecté
if (empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Requête et formatage en tableau associatif de la table users
$query = mysqli_query($con, 'SELECT * FROM users');
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);

// *********************************************
// AJOUTER UN UTILISATEUR

if (isset($_POST['submit'])) {

    if (
        !empty($_POST['firstname'])
        && !empty($_POST['lastname'])
        && !empty($_POST['email'])
        && !empty($_POST['password'])
    ) {

        $firstname = htmlspecialchars($_POST['firstname']);  // htmlspecialchars garde les accents ds la bdd, htmlentities non mais réaffiche si "select"
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $password  = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

        $requete = "INSERT INTO users (firstname, lastname, email, password)
                VALUES ('$firstname', '$lastname', '$email','$password')";
        $query_new_user = mysqli_query($con, $requete);

        if (mysqli_affected_rows($con) > 0)  // renvoit le nb de ligne ds le résultat de la requête, ici 1, on insère 1 ligne
        {
            header('Location:gestion_users_sql.php');
            $success_message = 'L\'utilisateur a bien été ajouté !';
        } else {
            $success_message = 'Un problème est survenu lors de l\'insertion';
        }

        // alternative
        // if (mysqli_query($con, $requete)) {         // si la requête est correcte
        //     $success_message = 'L\'utilisateur a bien été ajouté !';
        // } else {
        //     $success_message = "Erreur: " . $requete . "<br>" . mysqli_error($con);
        // }

    }
}


// *********************************************
// MODIFIER UN UTILISATEUR (3 champs obligatoires)

if (isset($_POST['update_user'])) {

    $index = $_POST['user_id'];

    if (
        !empty($_POST['userMaj']['firstname'])
        && !empty($_POST['userMaj']['lastname'])
        && !empty($_POST['userMaj']['email'])
    ) {
        $new_fn = htmlspecialchars($_POST['userMaj']['firstname']);
        $new_ln = htmlspecialchars($_POST['userMaj']['lastname']);
        $new_mail = htmlspecialchars($_POST['userMaj']['email']);

        $update_user_query = "UPDATE users SET firstname = '$new_fn',
                                                lastname = '$new_ln',
                                                email = '$new_mail'
                                WHERE ID = $index";


        if (mysqli_query($con, $update_user_query)) { // si la requête est correcte
            header('Location:gestion_users_sql.php');
            $success_update = 'L\'utilisateur a bien été mis à jour !';
        } else {
            $success_update = "Erreur: " . $update_user_query . "<br>" . mysqli_error($con);
        }
    }
}


// *********************************************
// SUPPRIMER UN UTILISATEUR

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    $delete_user_query = "DELETE FROM users WHERE ID=$user_id";

    if (mysqli_query($con, $delete_user_query))  // si la requête est correcte
    {
        $success_delete = 'L\'utilisateur a bien été supprimé !';
        header('Location:gestion_users_sql.php');
    } else {
        $success_delete = "Erreur: " . $requete . "<br>" . mysqli_error($con);
    }
}

//****************
// on ferme la connexion à la bdd
mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestion Users</title>
</head>

<body>
    <header>
        <a href="dashboard.php">Tableau de bord</a>
        <p class="title">GESTION DES UTILISATEURS</p>
        <a href="index.php?logout">Se déconnecter</a>
    </header>

    <?php if (!empty($users)) { ?>
        <table>
            <thead>
                <tr>

                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                </tr>
            </thead>

            <tbody>

                <?php
                foreach ($users as $user_id => $user_datas) { ?>

                    <tr>
                        <td><?php echo $user_datas['ID'] ?></td>
                        <td><?php echo $user_datas['firstname'] ?></td>
                        <td><?php echo $user_datas['lastname'] ?></td>
                        <td><?php echo $user_datas['email'] ?></td>
                        <td><?php echo $user_datas['password'] ?></td>
                    </tr>

                <?php
                }

                ?>

                <!------------------------------------------------------------------------  -->
                <!-- AJOUTER UN USER ------------------------------------------------------ -->
                <!------------------------------------------------------------------------  -->
                <form action="" method="post">
                    <tr>
                        <td></td>
                        <td><input type="text" name="firstname" id="prenom" class="champs" required></td>
                        <td><input type="text" name="lastname" id="Nom" class="champs" required></td>
                        <td><input type="email" name="email" id="mail" class="champs" required></td>
                        <td><input type="text" name="password" id="mdp" class="champs" required></td>

                        <td><input type="submit" name="submit" value="Ajouter"></td>
                    </tr>
                </form>

                <!------------------------------------------------------------------------  -->
                <!-- MODIFIER UN USER ------------------------------------------------------ -->
                <!------------------------------------------------------------------------  -->

                <form action="" method="POST">
                    <tr>
                        <td>
                            <select name="user_id">
                                <?php
                                foreach ($users as $user_id => $user_datas) { ?>
                                    <option><?= $user_datas['ID'] ?></option>
                                <?php } ?>
                        </td>
                        <td><input type="text" name="userMaj[firstname]" class="champs"></td>
                        <td><input type="text" name="userMaj[lastname]" class="champs"></td>
                        <td><input type="email" name="userMaj[email]" class="champs"></td>
                        <td><input type="text" name="userMaj[password]" class="champs"></td>

                        <td><input type="submit" name="update_user" value="Modifier"></td>
                    </tr>
                </form>

                <!------------------------------------------------------------------------  -->
                <!-- SUPPRIMER UN USER ------------------------------------------------------ -->
                <!------------------------------------------------------------------------  -->

                <form action="" method="POST">
                    <tr>
                        <td>
                            <select name="user_id">
                                <?php
                                foreach ($users as $user_id => $user_datas) { ?>
                                    <option><?= $user_datas['ID'] ?></option>
                                <?php } ?>
                        </td>
                        <td colspan="4">----------------------------------------------------------------------------------------------------------------------------</td>

                        <td><input type="submit" name="delete_user" value="Supprimer"></td>
                    </tr>
                </form>

            </tbody>

        </table>
    <?php } ?>

    <br>

    <?php if (isset($success_message)) { ?>
        <div class="success"><?= $success_message ?></div>
    <?php } ?>

    <?php if (isset($success_update)) { ?>
        <div class="success"><?= $success_update ?></div>
    <?php } ?>

    <?php if (isset($success_delete)) { ?>
        <div class="success"><?= $success_delete ?></div>
    <?php } ?>

</body>

</html>