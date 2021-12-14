<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Editer Ticket</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>

<script type="text/javascript">

</script>

<body>

  
  <!-- Insertion de la barre de naviguation et de l'entête -->
  <?php
  include "ElementsGraphiques/barre_de_naviguation.php";
  ?>


  <center><h2> Modification du ticket </h2>

    
   

    <?php
// Récupère idTiket
    $id=$_GET["idTicket"];

// Include le fichier de connection à la base de donnée
    include "connection.php";

// Requete pour récupérer les valeurs en base de données
    $requete = "SELECT * FROM TICKET WHERE idTicket = '$id' ";


// Vérification de la requete et affiche un message d'erreur si la requete est fausse
    $resultat = mysqli_query($connection,$requete);
    if (!$resultat){
      echo ("requete impossible".$connection->error); 
    }

// Afficher les données récupérer par la requête
    while($element = mysqli_fetch_array($resultat)){
      echo '   <div class="card" style="width: 35rem;">
      <div class="card-body"> <form name="monTicket" action="enregistrementModification.php" method="POST" enctype="multipart/form-data">';
      echo /*Id du ticket :*/'  <input type="hidden" class="form-control" name="idTicket" value="'.$element['idTicket'].'" /> </br>';
      echo 'Date de création du ticket :<input type="date" class="form-control" id="date" name="date" value="'.$element['DateDeCreation'].'" required /> </br>';
      echo ' Nom de la personne :<input type="text" class="form-control" name="nomUser" value="'.utf8_encode($element['nomUser']).'" /> </br>';

      echo ' Activité de la personne :<input type="text" class="form-control" name="activite" value="'.$element['activite'].'" /> </br>';

      echo ' Contact de la personne :<input type="email" class="form-control" pattern=".+@champion-direct.com" placeholder="Contact de la personne qui créé ce ticket: ...@champion-direct.com" required name="contact" value="'.$element['contact'].'" /> </br>';



// requête pour récuprer tous les tuples de la table domaineactivite
      $requeteDomaine = "SELECT * FROM domaineactivite";
      $resultatDomaine = mysqli_query($connection,$requeteDomaine);
      if (!$resultatDomaine){
        echo "requete impossible"; 
      }

// On affiche les éléments récupérer par notre requête
      echo 'Nom du domaine d activité de l anomalie :<select type="text" class="form-control" name="domaine" >';
      while($elementDomaine = mysqli_fetch_array($resultatDomaine)){   
        if ($elementDomaine['nom'] == $element['domaine']){
          echo '<option value="'.$elementDomaine['nom'].'" selected>'.$elementDomaine['nom'].'</option> ';
        }
        else {
          echo '<option value="'.$elementDomaine['nom'].'">'.$elementDomaine['nom'].'</option>';
        }
      }
      echo '</select></br>';


   // requête pour récuprer tous les tuples de la table FluxMetier
  $requeteTest = "SELECT * FROM casdetest";
  $resultatTest= mysqli_query($connection,$requeteTest);
  if (!$resultatTest){
    echo "requete impossible"; 
  }

// On affiche les éléments récupérer par notre requête
  echo 'Cas de Test :<select type="text" class="form-control" name="casDeTest" >';
  while($elementTest = mysqli_fetch_array($resultatTest)){   
    if ($elementTest['nom'] == $element['casDeTest']){
      echo '<option value="'.$elementTest['nom'].'" selected>'.$elementTest['nom'].'</option> ';
    }
    else {
      echo '<option value="'.$elementTest['nom'].'">'.$elementTest['nom'].'</option>';
    }
  }
  echo '</select></br>';

  // Chrono du cas de Test
  echo 'Chrono du cas de Test : </br>';
  echo ' <input type="number" name="chrono" class="form-control" min="1" value="'.$element['chrono'].'" required/> </br>';

  /*// requête pour récuprer tous les tuples de la table ecranm3
  $requeteEcran = "SELECT * FROM ecranm3";
  $resultatEcran= mysqli_query($connection,$requeteEcran);
  if (!$resultatEcran){
    echo "requete impossible"; 
  }

// On affiche les éléments récupérer par notre requête
  echo 'Code Ecran M3 :<select type="text" class="form-control" name="ecranM3" >';
  while($elementEcran = mysqli_fetch_array($resultatEcran)){   
    if ($elementEcran['codeEcran'] == $element['codeEcranM3']){
      echo '<option value="'.$elementEcran['codeEcran'].'" selected>'.$elementEcran['codeEcran'].'</option> ';
    }
    else {
      echo '<option value="'.$elementEcran['codeEcran'].'">'.$elementEcran['codeEcran'].'</option>';
    }
  }
  echo '</select></br>';*/



  echo 'Code de l ecran sur M3 : </br>';
  echo '<input type="text" name="ecranM3" class="form-control"  value="'.$element['codeEcranM3'].'"
  placeholder="Code de lécran M3 où l anomalie est apparu"  required   /> </br>';
  

  echo ' DonneesUtilisees pour le test :<input type="text" class="form-control" name="donneesUtilisees" value="'.utf8_encode($element['donneesUtilisees']).'" /> </br>';

  echo 'Aperçu de l anomalie survenu est : <img src="anomalies/'.$element['imageAnomalie'].'" style="width: 250px; height: 250px;" ></br>';

  echo 'Remplacer l image :</br>
  <input type="file" class="form-control" name="imageAnomalie" id="imageAnomalie" /></br></br>';

  echo ' Etat du test :<select type="text" class="form-control" name="etatTest" /> </br>';
  if ($element['etatTest']==0){
  echo '<option value="ko" selected>KO</option>
  <option value="ok">OK</option>      
  </select> ';
  }
  else{
  echo '<option value="ko">KO</option>
  <option value="ok" selected>OK</option>      
  </select> ';
  }


  echo ' Description de l anomalie :<textarea class="form-control" name="description">'. utf8_encode($element['description']).'</textarea></br>'; 

  echo ' Niveau de sévérité: </br> <div>';
  switch($element['severite']){
    case 1:
    echo '<input type="radio" id="severite" name="severite" value="1">
    <label for="bloquant">Bloquant</label>
    <input type="radio" id="severite" name="severite" value="2">
    <label for="problematique">Problématique</label>
    <input type="radio" id="severite" name="severite" value="3" checked>
    <label for="nonBloquant">Non bloquant</label>';
    break;

    case 2:
    echo '<input type="radio" id="severite" name="severite" value="1">
    <label for="bloquant">Bloquant</label>
    <input type="radio" id="severite" name="severite" value="2" checked>
    <label for="problematique">Problématique</label>
    <input type="radio" id="severite" name="severite" value="3">
    <label for="nonBloquant">Non bloquant</label>';
    break;

    case 3:
    echo '<input type="radio" id="severite" name="severite" value="1" checked>
    <label for="bloquant">Bloquant</label>
    <input type="radio" id="severite" name="severite" value="2">
    <label for="problematique">Problématique</label>
    <input type="radio" id="severite" name="severite" value="3">
    <label for="nonBloquant">Non bloquant</label>';
    break;
  }

  echo '</div> </br>';

  echo ' Correction faite : <select type="text" class="form-control" name="correction" /> ';
  if ($element['correction']==0){
  echo '<option value="non" selected>NON</option>
  <option value="oui">OUI</option> 
  </select></br> ';
  }  
  else {
  echo '<option value="non">NON</option>
  <option value="oui" selected>OUI</option> 
  </select></br> ';
  }     
  


  echo ' <input type="submit" class="btn btn-warning" value="Valider" ></br>';        
  echo ' </form></div></div><p></p></br>';
}



?>




</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>