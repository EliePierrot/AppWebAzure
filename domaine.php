<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Liste des domaine d'activité</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>

<body>

  <!-- Insertion de la barre de naviguation et de l'entête -->
  <?php
  include "ElementsGraphiques/barre_de_naviguation.php";

  include "connection.php";

  echo '<center> <div class="card border-dark mb-3" style="width: 85rem;">
<div class="card-body">';

// requête pour récuprer tous les tuples de la table domaineactivite
  $requeteDomaine = "SELECT * FROM domaineactivite";
  $resultatDomaine = mysqli_query($connection,$requeteDomaine);
  if (!$resultatDomaine){
    echo "requete impossible"; 
  }

// On affiche les éléments récupérer par notre requête
  echo '<center>
  <form name="monTicket" action="ticketDomaine.php" method="get">   <h2>Nom du domaine d activité</h2>
  <select type="text" class="form-control" name="domaine" />';
  while($elementDomaine = mysqli_fetch_array($resultatDomaine)){
    echo '<option value="'.$elementDomaine['nom'].'">'.$elementDomaine['nom'].'</option>';
  }
  echo '</select></br>
  <input type="submit" class="btn btn-warning" value="Valider" onclick="verifDonnees()"></br>
  </form></br></center>';

  ?>



</body>

<!-- Insertion du pied de page  --> 
<?php
echo "</div> </div> </center>";
include "ElementsGraphiques/pied_de_page.php";
?>

</html>