<?php
/******************* 
       SGBD
 *********************/

define("SERVEUR" , 'mysql:host=localhost');   		// Host 
define("BDD"	 , 'dbname=cheques'); 	// Nom de la base  
define("USER"	 , 'root'); 				  		// User 	
define("PASSWORD", '');						  		// Password	*

$auth = array("dalab331","flebo331"); //Seul utilisateur pouvant acceder à l'admin de la page

$calendrier = array();
$calendrier[1] = "Janvier";
$calendrier[2] = "Février";
$calendrier[3] = "Mars";
$calendrier[4] = "Avril";
$calendrier[5] = "Mai";
$calendrier[6] = "Juin";
$calendrier[7] = "Juillet";
$calendrier[8] = "Août";
$calendrier[9] = "Septembre";
$calendrier[10] = "Octobre";
$calendrier[11] = "Novembre";
$calendrier[12] = "Décembre";

$jour = date("Y-n"); //Date courante utilisé en paramètre au format AAAA-M
//$jour = "2011-6";   //Date dure utilisé en paramètre
$nbPrecedent = "-3"; //Nb de mois précédant la date
$nbSuivant = "+4"; //Nb de mois suivant la date