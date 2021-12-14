<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Création Ticket</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
</head>

<body>


  <!-- Insertion de la barre de naviguation et de l'entête -->
  <?php
  include "ElementsGraphiques/barre_de_naviguation.php";
  ?>

  <!-- Formulaire de création de ticket -->
  <center>
    <h2> Formulaire de création de Ticket </h2>
    <div class="card" style="width: 35rem;">
      <div class="card-body">
       <form name="monTicket" action="enregistrementTicket.php" method="POST" enctype="multipart/form-data">
        <b><i>Date de création du ticket :</i></b><input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required /> </br>
        <?php
       // on teste si le cookie login n'existe pas et on attribut une valeur par défaut à $nom
        if( !isset($_COOKIE['login']) ){
         $nom = "";
       }
       // Sinon $nom prend la valeur du cookie (login)
       else{
        $nom = addslashes($_COOKIE['login']);
      }

        // Include le fichier de connection à la base de donnée
      include "connection.php";

        // requête sql pour récupérer tous les tuples de la table utilisateur           
      $requete = "SELECT identifiant,activite,mail FROM utilisateur WHERE identifiant='$nom'";
      $resultat = mysqli_query($connection,$requete);
      if (!$resultat){
        echo "requete impossible"; 
      }

        // Initialisation des variables $activite et $contact
      $activite = "";
      $contact = "";

        // On affiche l'activite et le mail de l'élément récupérer par notre requête
      while($element = mysqli_fetch_array($resultat)){
        $activite = $element['activite'];
        $contact = $element['mail'];  
      }

      echo '<i><b>Nom de la personne : </i></b><input type="text" class="form-control" name="nomUser" placeholder="Entrez le nom de la personne qui créé ce ticket" required  value="'.utf8_encode($nom).'"/> </br>'; 

      echo '<i><b>Activité de la personne :</i></b><input type="text" class="form-control" name="activite"  placeholder="Entrez l activite de la personne qui créé ce ticket" required value="'.$activite.'"/> </br>';

      echo '<i><b>Contact de la personne :</i></b><input type="email" class="form-control" pattern=".+@champion-direct.com" name="contact"  placeholder="Contact de la personne qui créé ce ticket: ...@champion-direct.com" required value="'.$contact.'"/> </br>';




        // requête pour récuprer tous les tuples de la table domaineactivite
      $requeteDomaine = "SELECT * FROM domaineactivite";
      $resultatDomaine = mysqli_query($connection,$requeteDomaine);
      if (!$resultatDomaine){
        echo "requete impossible"; 
      }

        // On affiche les éléments récupérer par notre requête
      echo '<b><i>Nom du domaine d activité de l anomalie :</i></b>';
      echo '<select type="text" class="form-control" name="domaine" />';
      echo 'echo <option value="" style="font-style: italic">-- Veuillez selectionner le domaine concerné dans la liste déroulante --</option>';
      while($elementDomaine = mysqli_fetch_array($resultatDomaine)){
        echo '<option value="'.$elementDomaine['nom'].'">'.$elementDomaine['nom'].'</option>';

      }
      echo '</select></br>';

      


        // requête pour récupérer tous les tuples de la table Cas de Test
      $requeteTest = "SELECT * FROM casdetest";
      $resultatTest = mysqli_query($connection,$requeteTest);
      if (!$resultatTest){
        echo "requete impossible"; 
      }


        // On affiche les éléments récupérer par notre requête
      echo '<b><i>Nom du Cas de Test en cours :</i></b><select type="text" class="form-control" name="casDeTest" />';


      echo 'echo <option value="" style="font-style: italic">--Veuillez selectionner le cas de test concerné dans la liste déroulante--</option>';
      while($elementTest = mysqli_fetch_array($resultatTest)){
        echo '<option value="'.$elementTest['nom'].'">'.$elementTest['nom'].'</option>';
      }
      echo '</select></br>';

    

        // Chrono du cas de Test
      echo '<b><i>Chrono du cas de Test : </i></b></br>';
      echo ' <input type="number" name="chrono" class="form-control" min="1" required/> </br>';

      /*
        // requête pour récupérer tous les tuples de la table EcranM3
      $requeteEcran = "SELECT * FROM ecranm3";
      $resultatEcran = mysqli_query($connection,$requeteEcran);
      if (!$resultatEcran){
        echo "requete impossible"; 
      }

        // On affiche les éléments récuperer par notre requête
      echo '</br><i><b>Code de l ecran sur M3 :</i></b><select type="text" class="form-control" name="ecranm3" />';
      echo 'echo <option value="" style="font-style: italic">-- Selectionner le code de lécran M3 concerné dans la liste déroulante--</option>';
      while($elementEcran = mysqli_fetch_array($resultatEcran)){
        echo '<option value="'.$elementEcran['codeEcran'].'">'.$elementEcran['codeEcran'].'</option>';
      }
      echo '</select></br>';
      */
      ?>
      <i><b>Code de l ecran sur M3 :</b></i> </br>
      <input type="text" name="ecranm3" class="form-control"  placeholder="Code de lécran M3 où l'anomalie est apparu"  required/> </br>
    
      <b><i>Les données utilisées lors du test :</i></b><textarea class="form-control" name="donneesUtilisees" placeholder="Entrez les différentes données utilisées lors du test" required></textarea> </br>


      <b><i>Image de l'anomalie :</i></b></br>
      <input type="file" class="form-control" name="imageAnomalie" /></br></br> 

      <b><i>Etat du test :</i></b><select type="text" class="form-control" name="etatTest" /> </br>
      <option value="ko">KO</option>      
    </select></br>

    <b><i>Description de l'anomalie : </i></b><textarea class="form-control" name="description" placeholder="Veuillez décrire l'anomalie qui est servenue" required></textarea></br>


    <b><i>Niveau de sévérité: </i></b></br>
    <div>
      <input type="radio" id="severite" name="severite" required value="1">
      <label for="bloquant">Bloquant</label><p></p>
      <input type="radio" id="severite" name="severite" value="2">
      <label for="problematique">Problématique</label><p></p>
      <input type="radio" id="severite" name="severite" value="3">
      <label for="nonBloquant">Non bloquant</label>
    </div> </br>


    <b><i>Correction faite : </i></b><select type="text" class="form-control" name="correction" /> </br>        
    <option value="non">NON</option>
    <option value="oui">OUI</option>
  </select></br>

  <input type="submit" class="btn btn-warning" value="Valider et envoyer"> 

</form></br>



</div>
</div>
</center>

</body>

<!-- Insertion du pied de page  --> 
<?php
include "ElementsGraphiques/pied_de_page.php";
?>

</html>