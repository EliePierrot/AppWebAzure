<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Mail</title>
</head>
<?php

// Récupérer l'idTicket du ticket à envoyer et l'adresse mail de la personne qui va recevoir le ticket
$mail=$_GET["mail"];
$id=$_COOKIE['idTicket'];




// Connection à la base 
$connection = mysqli_connect('localhost','root','');

if (!$connection){
  echo "Connection a mysql impossible";
  
}

// Connection à la base easytickets
$base = mysqli_select_db($connection, 'easytickets');
if (!$base){
  echo "Connection a la base impossible";
  
}


// Si l'utilisateur choisit de ne pas remplacer l'image de l'anomalie, pour ne pas perdre l'image

$requeteEnvoie = "UPDATE TICKET 
SET envoye = 1
WHERE idTicket = '$id' ";        



// Vérification de la requete et affiche un message d'erreur si la requete est fausse
$resultatEnvoie = mysqli_query($connection,$requeteEnvoie);
if (!$resultatEnvoie){
  echo ("requete impossible".$connection->error); 
}


// Requete pour selectionner les donnees pa rapport à l id du ticket récupérer
$requete = "SELECT * FROM ticket  WHERE idTicket='$id' ";
$resultat = mysqli_query($connection,$requete);
if (!$resultat){
  echo "requete impossible";
  
}

// Afficher les données récupérer par la requête
while($element = mysqli_fetch_array($resultat)){
  $message = "Bonjour,</br> un utilisateur vient de vous envoyer ce ticket en rapport &agrave; une anomalie d&eacute;tecter lors du plateau de test du nouvel ERP Inform M3 de l'entreprise Champion. Veuillez trouver ci-joint les informations relatives &agrave; cette anomalie. </br></br>";
  $message .= "<b>L'identifiant du ticket est : </b>". $element['idTicket'].'</br>';
  $message .= "<b>La date de cr&eacute;ation du ticket est : </b>". $element['DateDeCreation'].'</br>';
  $message .= "<b>Le nom de l'utiliseur ayant cree ce ticket est : </b>". $element['nomUser'].'</br>';
  $message .= "<b>Le contact de l'utiliseur ayant cree ce ticket est : </b>". $element['contact'].'</br>';
  $message .= "<b>Le domaine ou l'anomalie est survenu est : </b>".$element['domaine'].'</br>';
  $message .= "<b>Le cas de Test concernant cette anomalie est  : </b>". $element['casDeTest'].'</br>';
  $message .= "<b>Le chrono du Cas de Test est : </b>".$element["chrono"].'</br>';
  $message .= "<b>Les donn&eacute;es utilis&eacute;es pour effectuer le test sont : </b>".$element['donneesUtilisees'].'</br>'; 
  $message .= "<b>L'&eacute;cran ou l'anomalie est survenu est : </b>".$element['codeEcranM3'].'</br>';
  $message .= '<b>Aper&ccedil;u de l anomalie survenu est :</b> http://172.22.20.151/EasyTickets/image.php?idTicket='.$element['idTicket'].'</br>';
 // $message .= "<b>L'&eacute;tat du test est (0 si faux et 1 si bon) : </b>". $element['etatTest'].'</br>';
  $message .= "<b>La d&eacute;scription concernant cette anomalie est   : </b>". $element['description'].'</br>';
  $message .= "<b>La s&eacute;v&eacute;rit&eacute; de cette anomalie est : </b> ";

  switch ($element['severite']) {
    case 1:
      $message .= "Bloquant </br> </br>";
      break;

    case 2:
      $message .= "Probl&eacute;matique </br> </br>";
      break;

    case 3:
      $message .= "Non Bloquant </br> </br>";
      break;
    
    default:
      $message .= "Non renseign&eacute; </br> </br>";
      break;
  }

  $message .= "Si vous avez des questions &agrave; propos de ce message, veuillez contacter la personne &agrave; l'origine de la cr&eacute;ation de ce ticket. ";
}


// Récupérer l'adresse mail destinatrice
$mail = strval($mail);
$destinataire = $mail;

// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
$expediteur = 'scan2mail@champion-direct.com';

$objet = 'Groupe Champion : Anomalie Infor M3'; // Objet du message

$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "Nom_de_expediteur"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire

    

if (mail($destinataire, $objet, $message, $headers)) // Envoi du message
{
  header('Location: envoyerMailOK.php');
}
else // Non envoyé
{
  echo "Votre message n'a pas pu être envoyé";
}
/*
$success = mail($destinataire, $objet, $message, $headers);
if (!$success) {
    $errorMessage = error_get_last()['message'];
}
*/

?>

</html>