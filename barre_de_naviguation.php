<?php

echo'
</br><h1 style="color: white;"> <center>EasyTickets</center>  </h1> 
      </br>


<center> <a href="https://www.groupe-champion.com/fr/"><img src="images/champion-direct-logo.jpg" style="width: 30%; height: 30%;" ></img></a>
    </center>

 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <link rel="stylesheet" href="monstyle.css">




    
    <div class="row" style="margin-top:5px;">
      <div class="col-md-12">
        <ul class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="creationTicket.php">Créer un ticket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="domaine.php">Tickets par domaines d activités</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="casdetest.php">Tickets par cas de test</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tableau.php">Tableau récapitulatif des tickets</a>
          </li>
          <form class="d-flex" action="recherche.php" method="GET">
        <input class="form-control me-2" type="text" placeholder="Rechercher" name="recherche" id="recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
      </form>
        </ul>
      </div>
    </div> </br>';

   /*echo '<center> <div class="card border-dark mb-3" style="width: 85rem;">
<div class="card-body">';*/



?>
