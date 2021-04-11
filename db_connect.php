<?php

$con = mysqli_connect("localhost","root","","td7_gestion_users"); // Connexion à la base de données

// Vérification de la connexion
if (mysqli_connect_errno()) {
  echo "Echec de la connexion à MySQL: " . mysqli_connect_error();
  exit;
}

// Modification du jeu de résultats en utf8
if (!mysqli_set_charset($con, "utf8")) {
   printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", mysqli_error($con));
}

?>