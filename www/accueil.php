<?php
require_once('connexion.php');
include 'securite.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Accueil</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php'; ?>
	  <div class="container">
<p>Bienvenue <?php echo $_SESSION['nom']; ?> 
  <?php echo $_SESSION['prenom']; ?> dans votre espace s&eacute;curis&eacute;. </p>
<p>Vous &ecirc;tes connect&eacute; en tant que &quot;<?php echo $_SESSION['login']; ?>&quot; avec le privil&egrave;ge &quot;<?php echo $_SESSION['privilege']; ?>&quot;</p>
<?php 
/*
--- AFFICHAGE CONDITIONNEL OU REDIRECTION EN FONCTION DU PRIVILEGE ---
	Config actuelle : le script gère un affichage conditionnel
	Pour rediriger l'utilisateur en fonction de son privilege, ajoutez les lignes suivantes aux endroits indiqués
	Dans la zone d'affichage admin : 
			header("Location:URL SI ADMIN")
	Dans la zone d'affichage admin : 
			header("Location:URL SI USER SIMPLE")
			
Note: pour ajouter des privilèges, editez ce fichier en rajoutant une condition d'affichage
et editez le fichier admin.php en ajoutant à la liste "select" un privilege.
*/
  
  
  // si l'utilisateur est connecté comme admin ...
  if ($_SESSION['privilege'] == "admin") { // Affichage conditionnel : si et seulement si l'utilisateur est connecté avec le privilege administrateur ?>
<strong>En tant qu'administrateur vous pouvez effectuer les actions suivantes : </strong></p>
<p><a href="admin.php">Gérer les utilisateurs</a>
  <?php } // fin de l'affichage conditionnel?></p>
<p>
  <?php 
  // si l'utilisateur est connecté comme simple utilisateur ...
  if ($_SESSION['privilege'] == "user") { // Affichage conditionnel : si et seulement si l'utilisateur est connecté avec le privilege utilisateur simple ?>
  <strong>En tant qu'utilisateur simple vous ne pouvez pas effectuer d'actions</strong>
  <?php } // fin de l'affichage conditionnel?>
</p>
<p align="left"><a href="index.php?erreur=logout"><strong>Vous déconnecter</strong></a></p>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
