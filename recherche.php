<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="icon" type="image/png" href="images/logo.png" />

</head>



<body>
 
  <!-- Insertion de la barre de naviguation et de l'entête -->
  <?php
  include "ElementsGraphiques/barre_de_naviguation.php";
  ?>
  

  <?php
// Récupérer la valeur saisis dans le formulaire de recherche

  $recherche=utf8_decode($_GET['recherche']);
  $recherche=addslashes($recherche);

// Include le fichier de connection à la base de donnée
  include "connection.php";

// Requête SQL pour récupérer l'ensemble des tickets dont le taux de sévérité est Bloquant
  $requete = "SELECT * FROM ticket   WHERE idTicket LIKE'%$recherche%'  OR nomUser LIKE'%$recherche%'  OR DateDeCreation LIKE'%$recherche%'  OR contact LIKE'%$recherche%' OR domaine LIKE'%$recherche%' OR casDeTest LIKE'%$recherche%' OR donneesUtilisees LIKE'%$recherche%'" ;
  $resultat = mysqli_query($connection,$requete);
  if (!$resultat){
    echo "requete impossible";
  }

  echo '<center><div class="card"> <div class="card-body">Résultat trouvé avec comme recherche : '.utf8_encode($recherche).' </div> </div></center></br>';

  echo ' <center>   <div class="card" style="width: 35rem;">
  <div class="card-body">';

// Afficher les tickets en rapport avec la recherche effectué
  $a = 1;
  while ($element = mysqli_fetch_array($resultat)){
    echo '<form name="monTicket" action="descriptionTicket.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$element['idTicket'].'> <i>En savoir plus   &#x2192</i> <input type="image"  src="images/ticket.PNG" id="imageTicket" ></form>';
    echo '<b> ticket '. $element['idTicket'].' : </b>';
    echo "La date de cration du ticket est : ". $element['DateDeCreation'].'</br>';
    echo "Le cas de Test de ce ticket est : ". utf8_encode($element['casDeTest']).'</br>';
    echo "Le chrono du cas de Test de ce ticket est : ". utf8_encode($element['chrono']).'</br>';
    echo "L'ecran ou l anomalie est survenu est : ".utf8_encode($element['codeEcranM3']).'</br>';
    echo '...'.'</br>';
    echo '_________________________________'.'</br>';
    $a = $a + 1;
  }
  if ($a == 1){
    echo '<p> Aucun résultat trouvé ! </p>'; 
  }
  echo '</div> </div></br>';


  ?>    


  
</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>