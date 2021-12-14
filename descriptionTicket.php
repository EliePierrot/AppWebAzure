<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Description Ticket</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>



<body>

  
 <!-- Insertion de la barre de naviguation et de l'entête -->
 <?php
 include "ElementsGraphiques/barre_de_naviguation.php";
 ?>

 
 <?php
// Récuperer l'id du ticket
 $id=$_GET["idTicket"];

// Include le fichier de connection à la base de donnée
 include "connection.php";

// Requete pour selectionner les donnees pa rapport à l id du ticket récupérer
 $requete = "SELECT * FROM ticket  WHERE idTicket='$id' ";
 $resultat = mysqli_query($connection,$requete);
 if (!$resultat){
  echo "requete impossible";
  
}

// Afficher les données récupérer par la requête
while($element = mysqli_fetch_array($resultat)){
  echo '<center><h2> Description du ticket </h2>';
  echo '<div class="card" style="width: 80rem;">
  <div class="card-body"><p>';
  echo "L identifiant du ticket est : ". utf8_encode($element['idTicket']).'</br>';
  echo "La date de création du ticket est : ". $element['DateDeCreation'].'</br>';
  echo "Le nom de l utiliseur ayant cree ce ticket est : ". utf8_encode($element['nomUser']).'</br>';
  echo "L'activité du créateur de ce ticket : ". $element['activite'].'</br>';
  echo "Le contact de l utiliseur ayant cree ce ticket est : ". utf8_encode($element['contact']).'</br>';
  echo "Le domaine ou l anomalie est survenu est : ".$element['domaine'].'</br>';
  echo "Le casDeTest concernant cette anomalie est  : ". utf8_encode($element['casDeTest']).'</br>';
  echo "Le chrono du casDetest est  : ". $element['chrono'].'</br>';
  echo "Les donnees utilisees pour effectuer le test sont : ".utf8_encode($element['donneesUtilisees']).'</br>'; 
  echo "L'ecran ou l anomalie est survenu est : ".utf8_encode($element['codeEcranM3']).'</br>';
  echo 'Aperçu de l anomalie survenu est : <img src="anomalies/'.utf8_encode($element['imageAnomalie']).'" ></br>';
 
  echo "L'état du test est : ";
  if($element['etatTest'] == 1){
    echo "OK </br>";
  }
  else{
    echo "KO </br>";
  }
  
  echo "La description concernant cette anomalie est   : ". utf8_encode($element['description']).'</br>';


  echo "La sévérité de cette anomalie est :  ";
  switch($element['severite']){
    case 1:
      echo "Bloquant";
      break;
    case 2:
      echo "Problématique";
      break;
    case 3:
      echo "Non Bloquant";
      break;
    default:
      echo "Non renseigné";
      break;
  }
  
  echo "</br>Si une correction a été déjà apporté à cet anomalie : ";
  if($element['correction'] == 1){
    echo "Oui </br>";
  }
  else{
    echo "Non </br>";
  }
  
  echo "Si ce ticket a déjà été envoyé à un consultant : ";
  if($element['envoye'] == 1){
    echo "Oui </br>";
  }
  else{
    echo "Non </br>";
  }

  echo '<form name="monTicket" action="editerTicket.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$element['idTicket'].'><input type="submit" class="btn btn-warning" value="Editer"></form></br>';

  echo '<form name="monTicket" action="contact.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$element['idTicket'].'><input type="submit" class="btn btn-warning" value="EnvoyerMail"></form>';

  echo '</div></div></p></center>';
}



?>


</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>