<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Contact</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>



<body>


  <?php 
  include "ElementsGraphiques/barre_de_naviguation.php";
  ?>


  <?php
session_start(); // lancement de la session
// Récupération de l'idTicket
$id=$_GET["idTicket"];
// Création d'un cookie à partir de la valeur récupérer
setcookie('idTicket',$id,time() + 60*60*24 ,null ,null, false, true);

// Include le fichier de connection à la base de donnée
include "connection.php";


// Requete pour selectionner les donnees pa rapport à l id du ticket récupérer
$requeteExpert = "SELECT * FROM expert ";
$resultatExpert = mysqli_query($connection,$requeteExpert);
if (!$resultatExpert){
  echo "requete impossible";
}

// Affichage du formulaire de saisis de co
echo '<center>';
echo '<form name="monTicket" action="test.php" method="get">';       
echo 'Contact à qui envoyer le mail :';
echo '<select type="text" class="form-control" name="mail" /> </br>';
// Afficher les données récupérer par la requête
while($elementExpert = mysqli_fetch_array($resultatExpert)){
  echo '<option value="'.$elementExpert['mail'].'">'.$elementExpert['mail'].'</option>';
}
echo '</select></br>';
echo '<input type="submit" class="btn btn-warning" value="Valider" ></br>';
echo '</form></br>';
echo '</center>';



// Requête pour recuperer tous les tuples de la table expert
$requeteContact = "SELECT * FROM expert ";
$resultatContact = mysqli_query($connection,$requeteContact);
if(!$resultatContact){
  echo 'requete impossible';
}

// Affichage de toutes les valeurs récupérer
while($elementContact = mysqli_fetch_array($resultatContact)){
  echo ' <center> <b>Consultant HETIC '.$elementContact['idExpert'].'</b> 
  <div class="card" style="width: 35rem;">
  <div class="card-body">
  Nom du Contact : '.$elementContact['nom'].'</br>Mail du Contact : '.$elementContact['mail'].' </br>Domaine Metier du Contact : '.utf8_encode($elementContact['domaine']).'
  </div>
  </div></br></center>';
}


?>

</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>