<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ 
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Modifier une commune</title>
		<meta http-equiv="Content-Type" content="text/html";>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include 'header.php'; ?>
	<div class="container">
	<?php
	
	if(isset($_POST['update'])){
	$nom="";
	$nom = $_POST['nom'];
	$adresse="";
	$adresse = $_POST['adresse'];
	$cp="";
	$cp = $_POST['cp'];
	$ville="";
	$ville = $_POST['ville'];
	$tel="";
	$tel = $_POST['telephone'];
	$mail="";
	$mail = $_POST['mail'];
	$nomcode="";
	$nomcode = $_POST['code'];
	$rat_commune = $_POST['rattachement'];
	$numero = $_POST['update'];
	$site="";
	$site = $_POST['site'];
	$update_query = "UPDATE commune SET rat_commune=\"$rat_commune\", nom=\"$nom\", adresse=\"$adresse\", codepost=\"$cp\", ville=\"$ville\", tel=\"$tel\", site=\"$site\", mail=\"$mail\", nomcode=\"$nomcode\" WHERE numero=\"$numero\"";
	mysqli_query($link, $update_query);
	
	
	
	
	}elseif (isset($_POST['modifier'])){
	$numero = $_POST['modifier'];
	$query = "SELECT * FROM commune WHERE numero=$numero";
	$result = mysqli_query($link, $query);

	$affichage = mysqli_fetch_array($result);
	
	$rat_commune = $affichage['rat_commune'];
	$nom = $affichage['nom'];
	$adresse = $affichage['adresse'];
	$cp = $affichage['codepost'];
	$ville = $affichage['ville'];
	$tel = $affichage['tel'];
	$mail = $affichage['mail'];
	$nomcode = $affichage['nomcode'];
	$site = $affichage['site'];
	}else{
	echo "<div class='alert alert-danger'><strong>Erreur</strong> : Pas de commune sélectionnée</div>";}
	?>
			
			<form class="form-horizontal" role="form" action="" method="post">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Modifier la commune de <strong><?php echo $nom." - Antenne N°".$numero;?></strong></h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
						<label for="nom" class="col-sm-4 control-label">Nom de l'antenne</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="adresse" class="col-sm-4 control-label">Adresse</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $adresse;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="cp" class="col-sm-4 control-label">Code Postal</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="cp" name="cp" value="<?php echo $cp;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="ville" class="col-sm-4 control-label">Ville</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="ville" name="ville" value="<?php echo $ville;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="telephone" class="col-sm-4 control-label">Téléphone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $tel;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="mail" class="col-sm-4 control-label">E-mail</label>
						<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail;?>">
							<div class="input-group-addon">@protectioncivile92.org</div>
						</div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="site" class="col-sm-4 control-label">Site internet</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="site" name="site" value="<?php echo $site;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="nomcode" class="col-sm-4 control-label">Code</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="code" name="code" value="<?php echo $nomcode;?>">
						</div>
					</div>
				</div>
				</div>
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Modifier le rattachement</h3>
					</div>
				<div class="panel-body">
					<div class="alert alert-warning" role="alert">
						<strong>Attention !</strong> La modification de ce champs implique de modifier l'appartenance juridique de la commune. Les membres de la commune vont être rattachée seront fusionnés.
					</div>
					<div class="form-group form-group-sm">
						<label for="rattachement" class="col-sm-4 control-label">Rattachement à la commune :</label>
						<div class="col-sm-8">
							<select class="form-control" name="rattachement" id="rattachement">
								<?php
								$listecommune_query = "SELECT numero_commune, nom_commune FROM rat_com";
								$listecommune_result = mysqli_query($link, $listecommune_query);
								while($listecommune = mysqli_fetch_array($listecommune_result)){
								if($listecommune["numero_commune"] == $rat_commune){
								echo "<option value='".$listecommune["numero_commune"]."' selected>".$listecommune["nom_commune"]."</option>";
								}else{
								echo "<option value='".$listecommune["numero_commune"]."'>".$listecommune["nom_commune"]."</option>";
								}}
								?>
							</select>
						</div>
					</div>
				</div>
				</div>
				 
				<?php echo "<input type='hidden' name='update' value='".$numero."'>"; ?>
				<div class="btn-group btn-group-justified" role="group">
					<div class="btn-group" role="group">
						<button type="submit" class="btn btn-warning">Modifier</button>
					</div>
				</div>
			</form>
	
	
	</div>
	<?php } include 'footer.php'; ?>
	</body>
</html>