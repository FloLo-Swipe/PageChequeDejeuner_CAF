<?php

/*******************************************************
Nom ......... : 
Role ........ : 
Auteur ...... : LE BORGNE FLORIAN
Version ..... : V1.0 du //
Licence ..... : DEI / CAF de la GIRONDE
 
Compilation : PHP version 5.3.5 -> Apache 2.2.17 
 ********************************************************/

class MyPdo
{

	// --------------------  Parametre de connection
	private static $serveur = SERVEUR;
	private static $bdd = BDD;
	private static $user = USER;
	private static $mdp = PASSWORD;
	private static $monPdo;
	private static $handle = null;


	// --------------------  Constructeur
	private function __construct()
	{
		try {
			MyPdo::$monPdo = new PDO(MyPdo::$serveur . ';' . MyPdo::$bdd, MyPdo::$user, MyPdo::$mdp);
			MyPdo::$monPdo->query("SET CHARACTER SET utf8");
		} catch (Exception $e) {
			echo '<br><br><br><br>Erreur de connexion a la BDD!'; //si erreur affichage d'une message
			die();
		}
	}


	// --------------------  Destructeur
	public function _destruct()
	{
		MyPdo::$monPdo = null;
	}


	// --------------------  instanciation
	public static function getPdo()
	{
		if (MyPdo::$handle == null) {
			MyPdo::$handle = new MyPdo();
		}
		return MyPdo::$handle;
	}


	// -------------------- Recuperation de la base
	public function recupBase()
	{
		$req = "SELECT * FROM donnees ORDER BY dateCommande DESC;";
		$res = MyPdo::$monPdo->query($req);

		if ($res != null) {
			$lesLignes = $res->fetchAll();
			return $lesLignes;
		}
	}

	// -------------------- Recuperation de la base du client
	// public function recupBaseClient($user1)
	// {
	// 	$req = "SELECT sn, givenname FROM ldap WHERE netusername LIKE '%$user1%'";
	// 	$res = MyPdo::$monPdo->query($req);

	// 	if ($res != null) {
	// 		$lesLignes = $res->fetchAll();
	// 		return $lesLignes;
	// 	}
	// }

	// -------------------- Recuperation de la base du client 2
	// public function recupDonneesClient($user1, $user2)
	// {
	// 	$req = "SELECT * FROM `donnees` WHERE `nom` LIKE '%$user1%' AND prenom LIKE '%$user2%'";
	// 	$res = MyPdo::$monPdo->query($req);

	// 	if ($res != null) {
	// 		$lesLignes = $res->fetchAll();
	// 		return $lesLignes;
	// 	}
	// }


	// -------------------- Suppression de la base
	public function suppBase()
	{
		$req = "DELETE FROM donnees WHERE id = $_REQUEST[id]";
		$res = MyPdo::$monPdo->query($req);

		if ($res != null) {
			$lesLignes1 = $res->fetchAll();
			return $lesLignes1;
		}
	}


	// -------------------- Insertion des données dans la base	
	public function insertDonnees()
	{

		$jour = date("Y-m-d");
		$req = "INSERT INTO `donnees` (`id`, `nom`, `prenom`, `numeroAgent`, `nombreCheque`, `type`,`dateEnr`,`dateCommande`) 
		VALUES (NULL, '$_REQUEST[nom]', '$_REQUEST[prenom]', '$_REQUEST[numeroAgent]', '$_REQUEST[nombreCheque]', '$_REQUEST[type]','$_REQUEST[mois]','" . $jour . "')";
		$res = Mypdo::$monPdo->query($req);

		if ($res != null) {
			$lesLignes1 = $res->fetchAll();
			return $lesLignes1;
		}
	}


	// public function ldapRecup($user)
	// {
	// 	$req1 = "SELECT * FROM ldap WHERE netusername LIKE '%$user%'";
	// 	$res1 = MyPdo::$monPdo->query($req1);

	// 	if ($res1 != null) {
	// 		$lesLignes = $res1->fetchAll();
	// 		return $lesLignes;
	// 	}
	// }

	public function resultatRecherche()
	{

		$where = "";
		if ($_REQUEST['nom']) {
			$where .= "nom LIKE '%" . $_REQUEST['nom'] . "%' AND ";
		}
		if ($_REQUEST['prenom']) {
			$where .= "prenom LIKE '%" . $_REQUEST['prenom'] . "%' AND ";
		}
		if ($_REQUEST['numeroAgent']) {
			$where .= "numeroAgent LIKE '%" . $_REQUEST['numeroAgent'] . "%' AND ";
		}
		if ($_REQUEST['type'] == "1") {
			$where .= "type LIKE '%1%' AND ";
		} else
		if ($_REQUEST['type'] == "0") {
			$where .= "type LIKE '%0%' AND ";
		} else
		if ($_REQUEST['type'] == "") {
		}

		// supprimer le dernier AND dans $Where 
		$where = substr($where, 0, -4);
		$order = $_REQUEST['trier'];

		if ($where == "") $where = 1;

		$req = "SELECT * FROM `donnees` WHERE ($where) $order";
		$res1 = MyPdo::$monPdo->query($req);

		if ($res1 != null) {
			$lesLignes = $res1->fetchAll();
			return $lesLignes;
		}
	}

	public function recupDonneesModif()
	{
		$req = "SELECT * FROM `donnees` WHERE id =" . $_REQUEST['id'];
		$res1 = MyPdo::$monPdo->query($req);
		if ($res1 != null) {
			$lesLignes = $res1->fetchAll();
			return $lesLignes;
		}
	}

	public function modifDonnees()
	{
		$jour = date("Y-m-d");
		$id = $_REQUEST['id'];

		$req = "UPDATE `donnees` SET `nom` ='" . $_REQUEST['nom'] . "', `prenom` ='" . $_REQUEST['prenom'] . "',`numeroAgent` ='" . $_REQUEST['numeroAgent'] . "', `nombreCheque` ='" . $_REQUEST['nombreCheque'] . "', `type` ='" . $_REQUEST['type12'] . "', `dateEnr` ='" . $_REQUEST['mois'] . "', `dateCommande` ='" . $jour . "' WHERE id =" . $id;
		$res = Mypdo::$monPdo->query($req);
		if ($res != null) {
			$lesLignes1 = $res->fetchAll();
			return $lesLignes1;
		}
	}
} // Fin CLASS
