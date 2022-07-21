<?php

class Outils {
/**
	*  Transforme la date au format AAAA/MM à dans un tableau sous forme M/AAAA
	* 
	* @param
	* $jour -> jour actuel
	* $nbPrecedent -> nbr de jour avant le jour actuel 
	* $nbSuivant -> nbr de jour apres le jour actuel 
	* return ->  tableau contenant les dates suiventes mis en entrer
	*/
function calendrierDateRoulant2($jour, $nbPrecedent, $nbSuivant){
    
	$maTable = array();

    for ($i = $nbPrecedent; $i <= $nbSuivant; $i++) {
        $l = date('Y-n', strtotime("$jour $i month")); //Permet d'affecter la date sous forme "2021-5"
        $pieces = explode("-", $l); //Permet de séparer la date précédent dans un tableau à 2 colonnes "Année"/"Mois
        $l = $pieces[1] . "/" . $pieces[0]; //Affiche la date sous forme "Juin/2021"
        array_push($maTable, $l); //Injecte la date dans un tableau
    	}
    return $maTable; //Retour les valeur du tableau
	}


/**
	* Transforme la date au format M/AAAA en format MOIS/AAAA
	* 
	* @param
	* $date -> date
	* return ->  une chaîne contenant le format souhaité 
	*/
	function transfoDate($date, $calendrier)
	{
		
		$r = explode("/", $date);
		$date = $calendrier[$r[0]]."/".$r[1];
		return $date;

	}


/**
	* Transforme la date au format JJ/MM/AAAA en format AAAA-MM-JJ
	* 
	* @param
	* $date -> date
	* return ->  une chaîne contenant le format souhaité 
	*/
	function dateUS1($date)
	{
		
		$r = explode("/", $date);
		$date = $r[2]."-".$r[1]."-".$r[0];
		return $date;

	}


	/**
	* Transforme la date au format MM/AAAA en format AAAA-MM
	* 
	* @param
	* $date -> date
	* return ->  une chaîne contenant le format souhaité 
	*/
	function dateUS2($date)
	{
		
		$r = explode("/", $date);
		$date = $r[1]."-".$r[0];
		return $date;

	}


	/**
	* Transforme la date au format AAAA-MM-JJ en format JJ/MM/AAAA 
	* 
	* @param
	* $date -> date
	* return ->  une chaîne contenant le format souhaité 
	*/
	function dateFR1($date)
	{
		$r = explode("-", $date);
		$date = $r[2]."/".$r[1]."/".$r[0];
		return $date;

	}


	/**
	* Transforme la date au format AAAA-MM-JJ en format JJ/MM/AAAA 
	* Transforme la date au format AAAA-MM en format MM/AAAA
	* @param
	* $date -> date
	* return ->  une chaîne contenant le format souhaité 
	*/
	function dateFR2($date)
	{
		$r = explode("-", $date);

		if(count($r) == 3){
		$date = $r[2]."/".$r[1]."/".$r[0];
		return $date;
		}

		else if (count($r) == 1){
		$date = $r[1]."/".$r[0];
		return $date;
		}
	}

	
	
}
