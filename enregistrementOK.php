<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Enregistrement OK</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>


<body>

  
  <!-- Insertion de la barre de naviguation et de l'entête -->
  <?php
  include "ElementsGraphiques/barre_de_naviguation.php";
  ?>


  <p> </p></br>

  <h1>  <center>Enregistrement du ticket réussi !</center>  </h1> </br>
  <center> <img src='images/reussi.png' style="width: 20%; height: 20%; border-color: red;" ></img>
  </center> </br>

  <center>
    <a href="creationTicket.php"><input type="submit" class="btn btn-secondary btn-lg" value="Creer un autre ticket"></a>
    <a href="domaine.php"><input type="submit" class="btn btn-secondary btn-lg" value="Consulter la liste des Tickets"></a> </br>
  </center>

</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>