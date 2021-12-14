<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="icon" type="image/png" href="images/logo.png" />

</head>



<body>
 
  
  <h1>  <center>EasyTickets</center>  </h1> 
</br>


<center> <img src='images/champion-direct-logo.jpg' style="width: 20%; height: 20%;" ></img>
</center> </br>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

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
        <a class="nav-link" href="domaine.html">Consulter la liste des tickets par domaines d'activités</a>
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
</div> </br>

<h2> FAQ </h2>

<center>
  <div class="card" style="width: 50rem;">
    <div class="card-body">

      <p><b>Je n’arrive pas à créer un ticket, mon image n’est pas prise en compte.</b></br>
      Les types de fichiers qui sont pris en comptes pour le traitement de l’image sont les 'jpg', 'jpeg', 'gif' et 'png'.</p></br>

      <p><b>Le système ne reconnait pas mon activité (QOFI/ACIER). </b> </br>
      Lorsque vous vous identifier sur la page d’accueil, le système prend en compte les valeurs déjà inscrite sur la table utilisateur. Si vous n’êtes pas enregistré dessus l’application ne pourra pas trouver votre activité. </p></br>

      <p><b>Je ne comprends pas bien le résultat de ma recherche dans la barre de menu.</b></br>
      Si vous effectuez une recherche à l'aide de la barre de menu, l'application va vous affichez tous les tickets comportant le mot que vous avez tappez dans la barre de recherche</p></br>

      <p><b>Je ne comprends pas bien le résultat de ma recherche dans la barre de menu.</b></br>
      Si vous effectuez une recherche à l'aide de la barre de menu, l'application va vous affichez tous les tickets comportant le mot que vous avez tappez dans la barre de recherche</p></br>

      <p><b> ... </b> </br>
      ... </p></br>

    </div>
  </div>
</center>


</body>

<footer style="width: 100%;  height: 0%; position: absolute; bottom: 0; ">
  <div class="row">
    <div class="col-md-12">
      <div class="card text-center">
        <div class="card-header">
          <p>© 2021 Groupe CHAMPION</p>
        </div>
      </div>
    </div>
  </div>
</footer>

</html>