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

  include "connection.php";

// Requete pour selectionner les donnees pa rapport à l id du ticket récupérer
  $requeteExpert = "SELECT * FROM utilisateur ORDER BY identifiant";
  $resultatExpert = mysqli_query($connection,$requeteExpert);
  if (!$resultatExpert){
    echo "requete impossible";
  }

  echo ' <center>   

  <center>
  <div class="card" style="width: 35rem;">
  <div class="card-body">
  <form action="login.php" method="post" >
  <b>Qui Êtes-vous ?</b></br>';
  echo '<select type="text" class="form-control" name="identifiant"  /> </br>';
  echo '<option value="" style="font-style: italic">--------- Veuillez selectionner votre nom dans la liste déroulante ---------</option>';

  while($elementUser = mysqli_fetch_array($resultatExpert)){
    echo '<option value="'.utf8_encode($elementUser['identifiant']).'">'.utf8_encode($elementUser['identifiant']).'</option>';
  }
  echo '</select></br>';
//<input type="text" class="form-control" name="login" placeholder="Entrez votre identifiant" /></br>
  echo ' <input type="submit" class="btn btn-warning" value="SeConnecter"/> '  ;
  echo ' </form></br>
  
  
  </div>
  </div>
  </center></br>';

  ?>
  
  <!-- Formulaire de login pour alimenter un cookie -->


  <!-- Texte de présentation de l'application -->
  <center>
   <div class="card" style="width: 60rem;">
    <div class="card-body">
      <p><i>   EasyTicket est une application de gestion de tickets  qui permet de créer un ticket en rapport à une anomalie détectée lors de la phase de tests du nouvel ERP infor M3. Ces tickets seront triés en fonction de leur niveau de sévérité et de leurs domaines d'activités. L’utilisateur pourra les affecter, par mail, à une personne chargée de les corriger.
      L’utilisateur de cette application pourra également consulter la liste des tickets en fonction de leur domaine d'activité. De plus, il pourra également  éditer un ticket pour modifier son état.</i></p>
    </div>
  </div>
</center></br>

<center><img src='images/EASYTICKETS.png' style=" position: static;  width: 200px; height: 200px;"></img></center>


</center>

</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>