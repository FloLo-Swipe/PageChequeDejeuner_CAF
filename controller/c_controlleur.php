<?php

/*******************************************************
Nom ......... : 
Role ........ : 
Auteur ...... : Le Borgne Florian
Version ..... : 1.0
Licence ..... : DEI / CAF de la GIRONDE
 ********************************************************/

// --------------------  On recupere la valeur action 
if (!isset($_REQUEST['action'])) {
	$action = 'accueil';
} // Si pas d'action accueil par defaut
else {
	$action = $_REQUEST['action'];
}

// --------------------  Suivant $action
switch ($action) {
	case 'accueil': {		// Données pour le menu deroulant 
			$result = outils::calendrierDateRoulant2($jour, $nbPrecedent, $nbSuivant);
			// Données SGBD
			$results1 = $pdo->recupBaseClient($user1);
			$results2 = $pdo->recupDonneesClient($results1[0]['sn'], $results1[0]['givenname']);
			// Interrroger LDAP ... 
			$results3 = $pdo->ldapRecup($user1);
			include("view/v_accueil.php");


			break;
		}


	case 'supprimer': {
			//$message = "La suppression de l'id ".$_REQUEST['id']." a été effectué";
			$pdo->suppBase();
			header("Location: http://localhost/test/projet1/index.php?action=admin");

			break;
		}

	case 'AffichageBase': {
			// Données pour le menu deroulant 
			$result = outils::calendrierDateRoulant2($jour, $nbPrecedent, $nbSuivant);
			// Données SGBD
			$results = $pdo->recupBase();
			include("view/v_accueil.php");

			break;
		}

	case 'validationCommande': {
			// Données pour le formulaire
			$pdo->insertDonnees();

			include("view/v_commande.php");

			break;
		}

	case 'validationModif': {
			// Données pour le formulaire
			$pdo->modifDonnees();

			include("view/v_modifier.php");

			break;
		}

	case 'admin': {
			if ($droit == 0) {
				header('Location: http://localhost/test/projet1/?action=refuser');
			} else if ($droit == 1) {

				/***************************
				 *  Enregistrement
				 *************************/
				if ($_REQUEST['save']) {
					//echo "======>".$_REQUEST['nom'];
					//$pdo->saveDonneesModif();
				}

				/***************************
				 *  Filtrer
				 *************************/
				$results = $pdo->resultatRecherche();
				$fp = fopen('export/file.csv', 'w');
				$fields = array();
				for ($pp = "0"; $pp < count($results); $pp++) {
					array_push($fields, $results[$pp]['nom'], $results[$pp]['prenom'], $results[$pp]['numeroAgent'], $results[$pp]['nombreCheque'], $results[$pp]['type'], $results[$pp]['dateEnr'], $results[$pp]['dateCommande'] . "\r\n");
				};
				fputcsv($fp, $fields);
				fclose($fp);


				/***************************
				 *  Modification
				 *************************/
				if ($_REQUEST['modifier']) {

					$results = $pdo->resultatRecherche();
					$id = $_REQUEST['id'];
					$result5 = outils::calendrierDateRoulant2($jour, $nbPrecedent, $nbSuivant);
					$results3 = $pdo->recupDonneesModif();
				}

				// Interrroger LDAP ... 
				$results2 = $pdo->ldapRecup($user1);
				include("view/v_admin.php");

				break;
			}
		}

	case 'refuser': {
			include("view/v_refuser.php");
		}

	case 'reset': {
			include("view/v_reset.php");
		}
}
