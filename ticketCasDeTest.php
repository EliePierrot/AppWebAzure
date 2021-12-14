<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Liste des tickets dans un domaine d'activité</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>



<body>

  
  <!-- Insertion de la barre de naviguation et de l'entête -->
  <?php
  include "ElementsGraphiques/barre_de_naviguation.php";
  ?>


  <?php
// Récupère le domaine d'activité
  $casdetest=$_GET["casdetest"];

// Include le fichier de connection à la base de donnée
  include "connection.php";

/*
// Requête SQL pour récupérer l'ensemble des tickets du domaine récupéré
$requete = "SELECT * FROM ticket  WHERE domaine='$domaine' ";
$resultat = mysqli_query($connection,$requete);
if (!$resultat){
  echo "requete impossible";
  
}
*/

// Requête SQL pour récupérer l'ensemble des tickets dont le taux de sévérité est Bloquant
$requeteBloquant = "SELECT * FROM ticket  WHERE severite=1 AND casDeTest='$casdetest'";
$resultatBloquant = mysqli_query($connection,$requeteBloquant);
if (!$resultatBloquant){
  echo "requete impossible";
  
}

// Requête SQL pour récupérer l'ensemble des tickets dont le taux de sévérité est Problematique
$requeteProblematique = "SELECT * FROM ticket  WHERE severite=2 AND casDeTest='$casdetest'";
$resultatProblematique = mysqli_query($connection,$requeteProblematique);
if (!$resultatProblematique){
  echo "requete impossible";
  
}

// Requête SQL pour récupérer l'ensemble des tickets dont le taux de sévérité est Non Bloquant
$requeteNonBloquant = "SELECT * FROM ticket  WHERE severite=3 AND casDeTest='$casdetest'";
$resultatNonBloquant = mysqli_query($connection,$requeteNonBloquant);
if (!$resultatNonBloquant){
  echo "requete impossible";
  
}

// Affichage des tickets dont la severité est bloquante
echo "<img src='images/urgent.PNG' ></img> <b>Niveau de sévérité (1) Bloquant </b> </br>";
echo ' <center>   <div class="card" style="width: 35rem;">
<div class="card-body">';
while ($elementBloquant = mysqli_fetch_array($resultatBloquant)){
  echo '<form name="monTicket" action="descriptionTicket.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$elementBloquant['idTicket'].'> <i>En savoir plus   &#x2192</i> <input type="image"  src="images/ticket.PNG" id="imageTicket" ></form>';
  echo '<b> ticket '. $elementBloquant['idTicket'].' : </b>';
  echo "La date de cration du ticket est : ". $elementBloquant['DateDeCreation'].'</br>';
  echo "Le cas de Test de ce ticket est : ". utf8_encode($elementBloquant['casDeTest']).'</br>';
  echo "Le chrono du cas de Test de ce ticket est : ". $elementBloquant['chrono'].'</br>';
  echo "Le code de l'ecran ou l anomalie est survenu est : ".utf8_encode($elementBloquant['codeEcranM3']).'</br>';
  echo "... </br>";
  echo '_________________________________'.'</br>';
}
echo '</div> </div> </center>';


// Affichage des tickets dont la sévértiré est Importante
echo "<img src='images/important.PNG' style='border-color: red;' ></img> <b>Niveau de sévérité (2) Problématique </b></br></br>";
echo ' <center>   <div class="card" style="width: 35rem;">
<div class="card-body">';
while ($elementProblematique = mysqli_fetch_array($resultatProblematique)){
  echo '<form name="monTicket" action="descriptionTicket.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$elementProblematique['idTicket'].'> <i>En savoir plus  &#x2192</i> <input type="image"  src="images/ticket.PNG" id="imageTicket" ></form>';
  echo '<b> ticket '. $elementProblematique['idTicket'].' : </b>';
  echo "La date de cration du ticket est : ". $elementProblematique['DateDeCreation'].'</br>';
  echo "Le cas de Test de ce ticket est : ". utf8_encode($elementProblematique['casDeTest']).'</br>';
  echo "Le chrono du cas de Test de ce ticket est : ". $elementProblematique['chrono'].'</br>';
  echo "Le code de l'ecran ou l anomalie est survenu est : ".$elementProblematique['codeEcranM3'].'</br>';
  echo "... </br>";
  echo '_________________________________'.'</br>';
}
echo '</div> </div> </center>';


// Affichage des tickets dont la severite est Non bloquante
echo "<img src='images/faible.PNG' style='border-color: red;' ></img> <b> Niveau de sévérité (3) Non Bloquant </b></br></br>";
echo ' <center>   <div class="card" style="width: 35rem;">
<div class="card-body">';
while ($elementNonBloquant = mysqli_fetch_array($resultatNonBloquant)){
  echo '<form name="monTicket" action="descriptionTicket.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$elementNonBloquant['idTicket'].'> <i>En savoir plus &#x2192</i> <input type="image"  src="images/ticket.PNG" id="imageTicket" ></form>';
  echo '<b> ticket '. $elementNonBloquant['idTicket'].' : </b>';
  echo "La date de cration du ticket est : ". $elementNonBloquant['DateDeCreation'].'</br>';
  echo "Le cas de Test de ce ticket est : ". utf8_encode($elementNonBloquant['casDeTest']).'</br>';
  echo "Le chrono du cas de Test de ce ticket est : ". $elementNonBloquant['chrono'].'</br>';
  echo "Le code de l'ecran ou l anomalie est survenu est : ".$elementNonBloquant['codeEcranM3'].'</br>';
  echo "... </br>";
  echo '_________________________________'.'</br>';
}
echo '</div> </div> </center></br>';


?>


</body>

<!-- Insertion du pied de page / Footer --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>