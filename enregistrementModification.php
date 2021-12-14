<?php
// Récupérer les données du formulaire
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
// Récupération des differentes données, decode sert à ne pas ne générer d'erreurs aux niveaux des caractères ayant des accents, addsslashes sert à ne pas générer d'erreurs pour les caratères spéciaux comme '/;": ...

$user=utf8_decode($_POST["nomUser"]);
$activite=utf8_decode($_POST["activite"]);
$dateCreation=utf8_decode($_POST["date"]);
$domaine=utf8_decode($_POST["domaine"]);

$contact=utf8_decode($_POST["contact"]);
$contact=addslashes($contact);

$casDeTest=utf8_decode($_POST["casDeTest"]);
$casDeTest=addslashes($casDeTest);

$chrono=$_POST["chrono"];

$donneesUtilisees=utf8_decode($_POST["donneesUtilisees"]);
$donneesUtilisees=addslashes($donneesUtilisees);

$ecranM3=utf8_decode($_POST["ecranM3"]);
$etatTest=utf8_decode($_POST["etatTest"]);

$description=utf8_decode($_POST["description"]);
$description=addslashes($description);

$severite=utf8_decode($_POST["severite"]);
$correction=utf8_decode($_POST["correction"]);

$id=$_POST["idTicket"];





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

// Si l'utilisateur choisit de ne pas remplacer l'image de l'anomalie, pour ne pas perdre l'image
if (!$image){
        $requete = "UPDATE TICKET 
        SET nomUser = '$user',activite = '$activite',contact = '$contact', domaine = '$domaine', casDeTest = '$casDeTest', chrono = '$chrono' , donneesUtilisees = '$donneesUtilisees', codeEcranM3 = '$ecranM3', etatTest = '$etatTest', description = '$description', severite = '$severite', correction = '$correction'
        WHERE idTicket = '$id' ";        
}

// Requete pour modifier les valeurs en base de données lorsqu'on modifie l'image de l'anomalie
else{
        $requete = "UPDATE TICKET 
        SET nomUser = '$user',activite = '$activite',contact = '$contact', domaine = '$domaine', casDeTest = '$casDeTest', donneesUtilisees = '$donneesUtilisees', codeEcranM3 = '$ecranM3', etatTest = '$etatTest', description = '$description', severite = '$severite', correction = '$correction', imageAnomalie = '$image'
        WHERE idTicket = '$id' ";

}

// Vérification de la requete et affiche un message d'erreur si la requete est fausse
$resultats = mysqli_query($connection,$requete);
if (!$resultats){
	echo ("requete impossible".$connection->error);	
}
else{
	header('Location: enregistrementModificationOK.php');
}






?>