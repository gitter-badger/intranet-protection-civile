<?php
include 'securite.php';
require_once('connexion.php');
include 'functions/str.php';

if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>

<?php
// script de traitement

if (isset($_POST['nom'])){
	$login = $_POST['prenom'].'.'.$_POST['nom'];
	$login = str_replace("'","", $login);
	$login = strtolower($login);
	$login = suppr_accents($login);
	if(($login == "") || ($_POST['pass'] == "")){
		$erreur = "erreur : formulaire vide";}
	if ($_POST['pass'] !== $_POST['pass2']) {
		$erreur = "erreur : mot de passe différents";}
	else{
		$verif_query = "SELECT * FROM membres WHERE login='$login'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $verif_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$utilisateur = mysqli_num_rows($verif);		
		if ($utilisateur){
			$erreur = "erreur : login déjà existant";}
		else {
			$pass = sha1($_POST['pass']);
			$nom = $_POST['nom'];
			$nom = str_replace("'","", $nom);
			$prenom = $_POST['prenom'];
			$prenom = str_replace("'","", $prenom);
			$privilege = $_POST['privilege'];
			$commune = $_POST['commune'];			
			$add_user = "INSERT INTO membres(login, pass, nom, prenom, commune, privilege) VALUES ('$login', '$pass', '$nom', '$prenom', '$commune','$privilege')" or die("Impossible d'ajouter l'utilisateur dans la base de donn&eacute;e" . mysqli_error($link));
			mysqli_query($link, $add_user);
			$succes = "Membre créé avec succès";
			
			
			
			
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Ajout d'un membre</title>
	<meta http-equiv="Content-Type" content="text/html";>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
<?php
if (!empty($erreur)){
echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$erreur."</div>";
}elseif (!empty($succes)){
echo "<div class='alert alert-success'><strong>Réussi</strong> : ".$succes."</div>";
}else{}
?>

		<h2>Création d'un membre</h2>
		<h4><?php if(isset($_GET['add']) && ($_GET['add'] == "ok")) { ?>Membre créé avec succès. <?php } ?></h4>
		<form class="form-horizontal" role="form" action="" name="add" method="post" autocomplete="off">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Informations</h3>
				</div>
			<div class="panel-body">
				<div class="form-group form-group-sm">
					<label for="nom" class="col-sm-4 control-label">Nom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="nom" name="nom" placeholder="Nom du membre">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="prenom" class="col-sm-4 control-label">Prénom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom du membre">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="pass" class="col-sm-4 control-label">Mot de passe</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="pass" name="pass" placeholder="">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="pass2" class="col-sm-4 control-label">Confirmation du mot de passe</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="pass2" name="pass2" placeholder="">
					</div>
				</div>
				<div class="form-group form-group-sm">
						<label for="commune" class="col-sm-4 control-label">Commune</label>
						<div class="col-sm-8">
							<select class="form-control" id="commune" name="commune">
								<?php							
								$reqliste = "SELECT numero_commune,nom_commune FROM rat_com" or die("Erreur lors de la consultation" . mysqli_error($link)); 
								$liste = mysqli_query($link, $reqliste);
								while($listecommune = mysqli_fetch_array($liste)) {
								echo "<option value='".$listecommune["numero_commune"]."'>".$listecommune["nom_commune"]."</option>";
								}							
								?>
							</select>
						</div>
					</div>
				<div class="form-group form-group-sm">
					<label for="privilege" class="col-sm-4 control-label">Privilège accordé</label>
					<div class="col-sm-8">
						<select class="form-control" id="privilege" name="privilege">
							<option value="user">Utilisateur</option>
							<option value="admin">Administrateur</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning">Envoyer</button>
				    </div>
				</div>
			</div>
		</form>
</div>
<?php } include 'footer.php'; ?>
</body>
</html>