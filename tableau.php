<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Tableau des tickets</title>
    <link rel="icon" type="image/png" href="images/logo.png" />

  </head>


 
  <body>
 
    <!-- Insertion de la barre de naviguation et de l'entête -->
<?php
include "ElementsGraphiques/barre_de_naviguation.php";
?>


<?php

// Include le fichier de connection à la base de donnée
include "connection.php";

// On teste si param1 existe et si oui on attribut à $var la valeur de param1
if(isset($_GET['param1'])){
  $var = $_GET['param1']; 
}

// Sinon on teste si param2 existe et si oui on attribut à $var la valeur de param2
elseif(isset($_GET['param2'])){
  $var = $_GET['param2']; 
}

// Sinon on teste si param3 existe et si oui on attribut à $var la valeur de param3
elseif(isset($_GET['param3'])){
  $var = $_GET['param3']; 
}

// Sinon on teste si param4 existe et si oui on attribut à $var la valeur de param4
elseif(isset($_GET['param4'])){
  $var = $_GET['param4']; 
}

// Sinon on teste si param5 existe et si oui on attribut à $var la valeur de param5
elseif(isset($_GET['param5'])){
  $var = $_GET['param5'];
}

// Sinon on teste si param6 existe et si oui on attribut à $var la valeur de param6
elseif(isset($_GET['param6'])){
  $var = $_GET['param6'];
}

// Sinon on teste si param7 existe et si oui on attribut à $var la valeur de param6
elseif(isset($_GET['param7'])){
  $var = $_GET['param7'];
}

// Sinon par defaut $var prend la valeur idTicket
else{
  $var = "idTicket";
}

// Requête SQL pour récupérer l'ensemble des tickets trié en fonction de la valeur de $var
$requete = "SELECT * FROM ticket Order By $var ASC" ;
$resultat = mysqli_query($connection,$requete);
if (!$resultat){
  echo "requete impossible";
  
}



// Création du tableau et affichage de l'entête
echo '<h2>Tableau de l ensemble des tickets :</h2>';
echo '<center><div class="card" style="width: 80rem;">';
echo '<div class="card-body">'; 
echo '<table class="table table-success table-striped">';
echo '<tr>
        <th scope="col"><a href="tableau.php" style="color: black;">Identifiant du Ticket</a> </th>
        <th scope="col"><a href="tableau.php?param1=domaine" style="color: black;">Domaine</a></th>
        <th scope="col"><a href="tableau.php?param7=casDeTest" style="color: black;">Cas de Test</a></th>
        <th scope="col"><a href="tableau.php?param2=severite" style="color: black;" >Sévérité</a></th>
        <th scope="col"><a href="tableau.php?param3=DateDeCreation" style="color: black;">Date de création</th>
       './* <th scope="col">Etat du Test</th>*/'
        <th scope="col"><a href="tableau.php?param4=correction" style="color: black;">Correction apportée</a></th>
        <th scope="col"><a href="tableau.php?param5=envoye" style="color: black;">Ticket envoyé par mail</a></th>
        <th scope="col"><a href="tableau.php?param6=nomUser" style="color: black;">Créateur du ticket</a></th>
      </tr>';
      
$i = 0;
// Ajouter une ligne au tableau pour chaque élément récupérer par la requête
while ($element = mysqli_fetch_array($resultat)){
  echo '<tr>';
  echo '<td>'.$element['idTicket'].'</td>';
  echo '<td>'.$element['domaine'].'</td>';
  echo '<td>'.$element['casDeTest'].'</td>';
  echo '<td>'.$element['severite'].'</td>';
  echo '<td>'.$element['DateDeCreation'].'</td>';

  /* etatTest est de type Boolean, sa valeur est donc soit 1, soit 0. Pour une question de lisibilité on affiche donc KO si c'est 1   ou OK si c'est 0
  if ($element['etatTest'] >= 1){
    echo '<td>OK</td>';
  }
  else{
    echo '<td><b>KO</b></td>';
  }
*/

  // correction est de type Boolean, sa valeur est donc soit 1, soit 0. Pour une question de lisibilité on affiche donc OUI si c'est 1   ou NON si c'est 0
  if ($element['correction'] >= 1){
    echo '<td>OUI</td>';
  }
  else{
    echo '<td><b>NON</b></td>';
  }  

  // envoye est de type Boolean, sa valeur est donc soit 1, soit 0. Pour une question de lisibilité on affiche donc OUI si c'est 1   ou NON si c'est 0
  if ($element['envoye'] >= 1){
    echo '<td>OUI</td>';
  }
  else{
    echo '<td><b>NON</b></td>';
  }  

  echo '<td>'.utf8_encode($element['nomUser']).'</td>';

  echo '<td><form name="monTicket" action="descriptionTicket.php" method="get"><input id="idTicket" name="idTicket" type="hidden" value='.$element['idTicket'].'><button type="sumbit" class="btn btn-warning" >En savoir plus</button></form></td>';
  echo '</tr>';
  $i = $i +1;
}

echo '<tr>';
echo '<th>Total de Tickets</th>';
echo '<th>'.$i.'</th>';
echo '</tr>';

echo '</table>';
echo '</div> </div></center>';

?>


    <!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>