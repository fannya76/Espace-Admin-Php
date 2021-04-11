<?php

require 'db_connect.php';

$query = mysqli_query($con, 'SELECT * FROM users'); // execute la requete qui récupère les users de la bdd
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);  // crée un tab associatif avec la bdd récupérée

foreach($users as $key => $user_datas )
{
    $requete = "UPDATE users SET password = '" . password_hash($user_datas['password'], PASSWORD_DEFAULT) . "' WHERE ID = " . $user_datas['ID'];
    $query = mysqli_query($con, $requete); // execute la query qui hash tous les mdp de la bdd
}

?>
