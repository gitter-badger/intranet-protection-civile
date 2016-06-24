<?php
	session_start(); // On relaye la session
		if (isset($_SESSION['authentification'])){ // vérification sur la session authentification (la session est elle enregistrée ?)
		// ici les éventuelles actions en cas de réussite de la connexion
	}
	else {
		header("Location: index.php?erreur=intru"); // redirection en cas d'echec
		exit;
	}
?>