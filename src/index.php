<?php session_start(); // début de session
require_once("connexion.php");

/*
			-----------------------------------
			---- SCRIPT D'AUTHENTIFICATION ----
					DBProtect V1.5
				Contact : david@borrat.net
				  Mise &agrave; jour php5
							+
			  cryptage sha1 par aventurier19
			-----------------------------------
*/



if (isset($_POST['login'])){ // execution apres envoi du formulaire
	$login = mysqli_real_escape_string($link, $_POST['login']); // mise en variable du nom d'utilisateur
	$pass = sha1($_POST['pass']); // mise en variable du mot de passe crypté
	
    // requete sur la table administrateurs (on récupère les infos de la personne)
	
	$verif_query = "SELECT * FROM $tablename_dbprotect WHERE login='$login' AND pass='$pass'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
	$verif = mysqli_query($link, $verif_query);
	$row_verif = mysqli_fetch_assoc($verif);
	$utilisateur = mysqli_num_rows($verif);

	
	if ($utilisateur) {	// On test s'il y a un utilisateur correspondant
	    $_SESSION['authentification'] = 1; // enregistrement de la session
		
		// déclaration des variables de session
		$_SESSION['privilege'] = $row_verif['privilege']; // le privilège de l'utilisateur (permet de définir des niveaux d'utilisateur)
		$_SESSION['nom'] = $row_verif['nom']; // Son nom
		$_SESSION['prenom'] = $row_verif['prenom']; // Son Prénom
		$_SESSION['login'] = $row_verif['login']; // Son Login
		//$_SESSION['pass'] = $row_verif['pass']; // Son mot de passe (à éviter)
		$_SESSION['commune'] = $row_verif['commune']; // Sa commune (ID)
		$_SESSION['role'] = $row_verif['id_role']; // Son rôle
		
		header("Location: accueil.php"); // redirection si OK
		exit;
}
	else {
		header("Location: index.php?erreur=login"); // redirection si utilisateur non reconnu
		exit;
	}
}


// GESTION DE LA Déconnexion
if (isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ // Test sur les paramètres d'URL qui permettront d'identifier un "contexte" de déconnexion
header("Location: index.php?erreur=delog");
exit;
}
?>
<html>
<head>
<title>Extranet - ADPC92</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
<link rel="stylesheet" href="css/signin.css" type="text/css" media="all" title="no title" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">

</head>
<body>
	<div class="container">
<form action="" method="post" name="connect" class="form-signin" role="form">
  <p align="center" class="Style7"><strong>      
      <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { // Affiche l'erreur
	  echo '<span class="label label-danger">login ou mot de passe incorrect</span>'; 
	  }
	  if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) { // Affiche l'erreur
	  echo '<span class="label label-success">Déconnexion réussie</span>';
	  session_unset();
	  }
	  if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) { // Affiche l'erreur 
	  echo '<span class="label label-danger">Vous n\'avez pas les droits pour afficher cette page.</span>';
      } ?>
  <h2 class="form-signin-heading">Extranet ADPC92</h2>
    <input name="login" type="text" class="form-control" placeholder="Identifiant" required="" autofocus="">
	<input type="password" name="pass" class="form-control" placeholder="Mot de passe" required="" id="pass">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
</form>
</div>
</body>
</html>