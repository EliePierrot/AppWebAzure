<?php

$image=addslashes(utf8_decode($_FILES['imageAnomalie']['name']));
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['imageAnomalie']) AND $_FILES['imageAnomalie']['error'] == 0)
{
        // Verifier la taille du fichier
    if ($_FILES['imageAnomalie']['size'] <= 1000000)
    {
                // Verifier l'extension
        $infosfichier = pathinfo($_FILES['imageAnomalie']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png','PNG','JPG','JPEG', 'GIF');
        if (in_array($extension_upload, $extensions_autorisees))
        {
                        // Stocker le fichier dans le dossier anomalies
            move_uploaded_file($_FILES['imageAnomalie']['tmp_name'], 'anomalies/' . utf8_decode(basename($_FILES['imageAnomalie']['name'])));
            echo "L'envoi a bien été effectué !";
        }
    }
}

// Récupérer les données du formulaire 
//decode sert à garder les accents en base et ne pas générer d'erreur
//addslashes sert à mettre des / avant les caractères spéciaux comme '," pour ne pas générer d'erreur

$user=utf8_decode($_POST["nomUser"]);
$dateCreation=utf8_decode($_POST["date"]);

$contact=utf8_decode($_POST["contact"]);
$contact=addslashes($contact);

$activite=utf8_decode($_POST["activite"]);

$domaine=utf8_decode($_POST["domaine"]);
//$domaine=$_POST["domaine"];

$casDeTest=utf8_decode($_POST["casDeTest"]);
$casDeTest=addslashes($casDeTest);

$chrono=$_POST["chrono"];

$donneesUtilisees=utf8_decode($_POST["donneesUtilisees"]);
$donneesUtilisees=addslashes($donneesUtilisees);

$ecranM3=utf8_decode($_POST["ecranm3"]);

$etatTest=utf8_decode($_POST["etatTest"]);

$description=utf8_decode($_POST["description"]);
$description=addslashes($description);

$severite=utf8_decode($_POST["severite"]);
$correction=utf8_decode($_POST["correction"]);


/*
$i = 0;
while ($i < count($domaine)) {
    echo $domaine[$i]; 
    $i = $i +1;
}
*/


// Variable qui servira à définir l' idTicket
$compteur = 0;

// Transformer la valeur du formulaire en un chiffre pour que les données soient bien intégrées en base de données
if (strcmp($etatTest, "ko")==0){
	$etatTest=0;
}
else{
	$etatTest=1;
}

// Transformer la valeur du formulaire en un chiffre pour que les données soient bien intégrées en base de données
if (strcmp($correction, "non")==0){
	$correction=0;
}
else{
	$correction=1;
}

// Include le fichier de connection à la base de donnée
include "connection.php";

// requête pour avoir tous les tickets qui servira à compter le nombre de tickets existants pour définir l' idTicket
$requeteId = "SELECT idTicket FROM TICKET";
$resultatId = mysqli_query($connection,$requeteId);
if (!$resultatId){
  echo "requete impossible";
  
}

// Requete pour insérer les valeurs en base de données
$requete = "INSERT INTO TICKET (DateDeCreation, nomUser, activite,contact, domaine, casDeTest, chrono, donneesUtilisees, codeEcranM3, etatTest, description, severite, correction, imageAnomalie) VALUES
('$dateCreation','$user','$activite','$contact' , '$domaine','$casDeTest', '$chrono','$donneesUtilisees','$ecranM3','$etatTest','$description','$severite','$correction','$image'); ";


// Vérification de la requete et affiche un message d'erreur si la requete est fausse
$resultats = mysqli_query($connection,$requete);
if (!$resultats){
	echo ("requete impossible".$connection->error);	
}
else{
	header('Location: enregistrementOK.php');
}





?>