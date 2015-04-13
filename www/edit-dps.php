<?php
include 'securite.php';
require_once('connexion.php');


if(isset($_POST['id'])){
$id = $_POST['id'];
$query = "SELECT * FROM demande_dps WHERE id = '$id'";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);
$cu = $dps['cu_complet'];
}elseif(isset($_SESSION['dps-creation'])){
$cu = $_SESSION['dps-creation'];
$query = "SELECT * FROM demande_dps WHERE cu_complet = '$cu'";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);
unset($_SESSION['dps-creation']);
}elseif(isset($_SESSION['dps-update'])){
$id = $_SESSION['dps-update'];
$query = "SELECT * FROM demande_dps WHERE id = '$id'";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);
$cu = $dps['cu_complet'];
unset($_SESSION['dps_update']);
}else{header("Location: list-dps.php"); exit;}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Demande DPS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	<link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
	<script src="js/fileinput.js" type="text/javascript"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
		<?php if ($_SESSION['privilege'] == "admin") {?>
			<h2>Formulaire : Demande de DPS</h2>
			<h3>Demande : <?php echo $cu; ?></h3>
			
			<?php
			if($_SESSION['commune'] == "0"){
			?>
			<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Accès spécial DDO</h3>
					</div>
				<div class="panel-body">
					Formulaire de validation ou refus.
				</div>
			</div>
			<?php }?>
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Gestion des fichiers</h3>
					</div>
				<div class="panel-body">
					<form enctype="multipart/form-data">
					<div class="form-group">
						<input id="input-risk" type="file" accept="application/pdf" data-preview-file-type="any">
							<script>
							$("#input-risk").fileinput({
							previewFileType: "image",
							browseClass: "btn btn-success",
							browseLabel: "Pick Image",
							browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
							removeClass: "btn btn-danger",
							removeLabel: "Delete",
							removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
							uploadClass: "btn btn-info",
							uploadLabel: "Upload",
							uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
							});
							</script>
						</div>
					</form>
				</div>
			</div>
			
			<form class="form-horizontal" role="form" action="traitement-demande-dps.php" method="post">
			<input type='hidden' name='update_id' value='<?php echo $dps['id'];?>'>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Organisateur</h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
						<label for="nom_organisation" class="col-sm-4 control-label">Nom de l'organisation <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Nom de la société, association, collectivité, etc."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" placeholder="Nom de l'organisation" value="<?php echo $dps['organisateur']; ?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="represente_par" class="col-sm-4 control-label">Représenté par <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Personne qui représente l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="represente_par" name="represente_par" placeholder="Représentant" value="<?php echo $dps['representant_org']; ?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="qualite" class="col-sm-4 control-label">Qualité <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Statut du représentant."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="qualite" name="qualite" placeholder="Qualité" value="<?php echo $dps['qualite_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="adresse" class="col-sm-4 control-label">Adresse postale <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse, code postale, ville."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $dps['adresse_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="telephone" class="col-sm-4 control-label">Téléphone <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="telephone" name="telephone" placeholder="telephone" value="<?php echo $dps['tel_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="fax" class="col-sm-4 control-label">Fax <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php echo $dps['fax_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="email" class="col-sm-4 control-label">E-mail <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse e-mail du représentant ou de l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $dps['email_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="deja_pref" class="col-sm-4 control-label">Dossier déjà déposé en préfecture ?</label>
						<div class="col-sm-8">
							<select class="form-control" name="deja_pref" id="deja_pref">
								<option value="false">Non</option>
								<option value="true" <?php if($dps['dossier_pref'] == true){ echo "selected";}?>>Oui</option>
							</select>
						</div>
					</div>
				</div>
			</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Nature de la manifestation</h3>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm">
							<label for="nom_nature" class="col-sm-4 control-label">Nom / Nature <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Nom/Nature de la manifestation"></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nom_nature" name="nom_nature" placeholder="Nom / Nature" value="<?php echo $dps['description_manif'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="activite_descriptif" class="col-sm-4 control-label">Activité / Descriptif <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Descriptif court."></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="activite_descriptif" name="activite_descriptif" placeholder="Activité / Descriptif" value="<?php echo $dps['activite'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="lieu_precis" class="col-sm-4 control-label">Lieu précis <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse la plus précise possible du lieu de l'événement."></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lieu_precis" name="lieu_precis" placeholder="Adresse précise du lien de l'évenement" value="<?php echo $dps['adresse_manif'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure du début</label>
							<div class="col-sm-6">
								<select class="form-control" id="jour_debut" name="date_debut">
									<?php
									$date_debut = $dps['dps_debut'];
									$jour_debut = substr($date_debut,-2);
									$mois_debut = substr($date_debut,5,7);
									$annee_debut = substr($date_debut,0,4);
								$i = 1;
								while($i <= 31){
									if($i == $jour_debut){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="mois_debut" name="date_debut">
									<option value="1" <?php if($mois_debut == 1){echo "selected";}?>>Janvier</option>
									<option value="2" <?php if($mois_debut == 2){echo "selected";}?>>Février</option>
									<option value="3" <?php if($mois_debut == 3){echo "selected";}?>>Mars</option>
									<option value="4" <?php if($mois_debut == 4){echo "selected";}?>>Avril</option>
									<option value="5" <?php if($mois_debut == 5){echo "selected";}?>>Mai</option>
									<option value="6" <?php if($mois_debut == 6){echo "selected";}?>>Juin</option>
									<option value="7" <?php if($mois_debut == 7){echo "selected";}?>>Juillet</option>
									<option value="8" <?php if($mois_debut == 8){echo "selected";}?>>Août</option>
									<option value="9" <?php if($mois_debut == 9){echo "selected";}?>>Septembre</option>
									<option value="10" <?php if($mois_debut == 10){echo "selected";}?>>Octobre</option>
									<option value="11" <?php if($mois_debut == 11){echo "selected";}?>>Novembre</option>
									<option value="12" <?php if($mois_debut == 12){echo "selected";}?>>Décembre</option>
								</select>
								<select class="form-control" id="annee_debut" name="date_debut">
									<option value="<?php echo date("Y") ?>"<?php if($annee_debut == date("Y")){echo "selected";}?>><?php echo date("Y") ?></option>
									<option value="<?php echo date("Y")+1 ?>"<?php if($annee_debut == date("Y")+1){echo "selected";}?>><?php echo date("Y")+1 ?></option>
									<option value="<?php echo date("Y")+2 ?>"<?php if($annee_debut == date("Y")+2){echo "selected";}?>><?php echo date("Y")+2 ?></option>
									<option value="<?php echo date("Y")+3 ?>"<?php if($annee_debut == date("Y")+3){echo "selected";}?>><?php echo date("Y")+3 ?></option>
								</select>
							</div>
							<div class="col-sm-2">
								<select class="form-control" id="h_debut" name="date_debut">
									<?php
									$heure_debut = $dps['heure_debut'];
									$m_debut = substr($heure_debut,-2);
									$h_debut = substr($heure_debut,0,2);
								$i = 00;
								while($i <= 23){
									if($i == $h_debut){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="m_debut" name="date_debut">
									<?php 
								$i = 00;
								while($i <= 59){
									if($i == $m_debut){
										echo "<option value='".$i."' selected>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
										$i++;
										}
								?>
								</select>
							</div>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_fin" class="col-sm-4 control-label">Date et heure de fin</label>
							<div class="col-sm-6">
								<select class="form-control" id="jour_fin" name="date_fin">
									<?php
									$date_fin = $dps['dps_fin'];
									$jour_fin = substr($date_fin,-2);
									$mois_fin = substr($date_fin,5,7);
									$annee_fin = substr($date_fin,0,4);
								$i = 1;
								while($i <= 31){
									if($i == $jour_fin){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="mois_fin" name="date_fin">
									<option value="1" <?php if($mois_fin == 1){echo "selected";}?>>Janvier</option>
									<option value="2" <?php if($mois_fin == 2){echo "selected";}?>>Février</option>
									<option value="3" <?php if($mois_fin == 3){echo "selected";}?>>Mars</option>
									<option value="4" <?php if($mois_fin == 4){echo "selected";}?>>Avril</option>
									<option value="5" <?php if($mois_fin == 5){echo "selected";}?>>Mai</option>
									<option value="6" <?php if($mois_fin == 6){echo "selected";}?>>Juin</option>
									<option value="7" <?php if($mois_fin == 7){echo "selected";}?>>Juillet</option>
									<option value="8" <?php if($mois_fin == 8){echo "selected";}?>>Août</option>
									<option value="9" <?php if($mois_fin == 9){echo "selected";}?>>Septembre</option>
									<option value="10" <?php if($mois_fin == 10){echo "selected";}?>>Octobre</option>
									<option value="11" <?php if($mois_fin == 11){echo "selected";}?>>Novembre</option>
									<option value="12" <?php if($mois_fin == 12){echo "selected";}?>>Décembre</option>
								</select>
								<select class="form-control" id="annee_fin" name="date_fin">
									<option value="<?php echo date("Y") ?>"<?php if($annee_fin == date("Y")){echo "selected";}?>><?php echo date("Y") ?></option>
									<option value="<?php echo date("Y")+1 ?>"<?php if($annee_fin == date("Y")+1){echo "selected";}?>><?php echo date("Y")+1 ?></option>
									<option value="<?php echo date("Y")+2 ?>"<?php if($annee_fin == date("Y")+2){echo "selected";}?>><?php echo date("Y")+2 ?></option>
									<option value="<?php echo date("Y")+3 ?>"<?php if($annee_fin == date("Y")+3){echo "selected";}?>><?php echo date("Y")+3 ?></option>
								</select>
							</div>
							<div class="col-sm-2">
								<select class="form-control" id="h_fin" name="date_fin">
									<?php
									$heure_fin = $dps['heure_fin'];
									$m_fin = substr($heure_fin,-2);
									$h_fin = substr($heure_fin,0,2);
								$i = 00;
								while($i <= 23){
									if($i == $h_fin){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="m_fin" name="date_fin">
									<?php 
								$i = 00;
								while($i <= 59){
									if($i == $m_fin){
										echo "<option value='".$i."' selected>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
										$i++;
										}
								?>
								</select>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="departement" class="col-sm-4 control-label">Département où se situe la manifestation <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Exemple : 92"></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="departement" name="departement" placeholder="Département" value="<?php echo $dps['dept'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="prix" class="col-sm-4 control-label">Prix <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Tarif facturé au client."></span></label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="number" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php echo $dps['prix'];?>">
									<div class="input-group-addon">euros
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Dimensionnement du poste <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet le calcul de la grille des risques."></span></h3>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm">
							<label for="spectateurs" class="col-sm-4 control-label">Nombre de spectateurs <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Chiffres uniquement."></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="spectateurs" name="spectateurs" placeholder="Spectateurs" value="<?php echo $dps['p1_spec'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="participants" class="col-sm-4 control-label">Nombre de participants <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Chiffres uniquement."></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="participants" name="participants" placeholder="Participants" value="<?php echo $dps['p1_part'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="activite" class="col-sm-4 control-label">Activité du rassemblement </label>
							<div class="col-sm-8">
								<select class="form-control" id="activite" name="activite">
									<option value="1" <?php if($dps['p2'] == "1"){ echo "selected";}?>>Public assis (spectacle, réunion, restauration, etc.)</option>
									<option value="2" <?php if($dps['p2'] == "2"){ echo "selected";}?>>Public debout (Exposition, foire, salon, exposition, etc.)</option>
									<option value="3" <?php if($dps['p2'] == "3"){ echo "selected";}?>>Public debout actif (Spectacle avec public statique, fête foraine, etc.)</option>
									<option value="4" <?php if($dps['p2'] == "4"){ echo "selected";}?>>Public debout à risque (public dynamique, danse, féria, carnaval, etc.)</option>
								</select>
								<span class="help-block">Niveau de risque (P2)</span>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="environnement" class="col-sm-4 control-label">Environnement et accessibilité</label>
							<div class="col-sm-8">
								<select class="form-control" id="environnement" name="environnement">
									<option value="1" <?php if($dps['e1'] == "1"){ echo "selected";}?>>Faible (Structure permanente, voies publiques, etc.)</option>
									<option value="2" <?php if($dps['e1'] == "2"){ echo "selected";}?>>Modéré (Gradins, tribunes, mois de 2 hectares, etc.)</option>
									<option value="3" <?php if($dps['e1'] == "3"){ echo "selected";}?>>Moyen (Entre 2 et 5 hectares, autres conditions, etc.)</option>
									<option value="4" <?php if($dps['e1'] == "4"){ echo "selected";}?>>Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)</option>
								</select>
								<span class="help-block">Caractéristiques de l'environnement et accessibilité du site (E1)</span>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="delai" class="col-sm-4 control-label">Délai d'intervention des secours publics</label>
							<div class="col-sm-8">
								<select class="form-control" id="delai" name="delai">
									<option value="1" <?php if($dps['e2'] == "1"){ echo "selected";}?>>Faible (Moins de 10 minutes)</option>
									<option value="2" <?php if($dps['e2'] == "2"){ echo "selected";}?>>Modéré (Entre 10 et 20 minutes)</option>
									<option value="3" <?php if($dps['e2'] == "3"){ echo "selected";}?>>Moyen (Entre 20 et 30 minutes)</option>
									<option value="4" <?php if($dps['e2'] == "4"){ echo "selected";}?>>Elevé (Plus de 30 minutes)</option>
								</select>
								<span class="help-block">Délai d'intervention (E2)</span>
							</div>
						</div>
						<textarea class="form-control" rows="4" id="commentaire_ris" name="commentaire_ris" placeholder="Indiquer ici tout commentaire(s) concernant le RIS"><?php echo $dps['comment_ris'];?></textarea>
						<span class="help-block">Commentaires concernant le RIS</span>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Configuration du dispositif prévisionnel de secours mis en place</h3>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure du fin du poste</label>
							<div class="col-sm-6">
								<select class="form-control" id="jour_debut_poste" name="date_debut_poste">
									<?php
									$date_debut_poste = $dps['dps_debut_poste'];
									$jour_debut_poste = substr($date_debut_poste,-2);
									$mois_debut_poste = substr($date_debut_poste,5,7);
									$annee_debut_poste = substr($date_debut_poste,0,4);
								$i = 1;
								while($i <= 31){
									if($i == $jour_debut_poste){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="mois_debut_poste" name="date_debut_poste">
									<option value="1" <?php if($mois_debut_poste == 1){echo "selected";}?>>Janvier</option>
									<option value="2" <?php if($mois_debut_poste == 2){echo "selected";}?>>Février</option>
									<option value="3" <?php if($mois_debut_poste == 3){echo "selected";}?>>Mars</option>
									<option value="4" <?php if($mois_debut_poste == 4){echo "selected";}?>>Avril</option>
									<option value="5" <?php if($mois_debut_poste == 5){echo "selected";}?>>Mai</option>
									<option value="6" <?php if($mois_debut_poste == 6){echo "selected";}?>>Juin</option>
									<option value="7" <?php if($mois_debut_poste == 7){echo "selected";}?>>Juillet</option>
									<option value="8" <?php if($mois_debut_poste == 8){echo "selected";}?>>Août</option>
									<option value="9" <?php if($mois_debut_poste == 9){echo "selected";}?>>Septembre</option>
									<option value="10" <?php if($mois_debut_poste == 10){echo "selected";}?>>Octobre</option>
									<option value="11" <?php if($mois_debut_poste == 11){echo "selected";}?>>Novembre</option>
									<option value="12" <?php if($mois_debut_poste == 12){echo "selected";}?>>Décembre</option>
								</select>
								<select class="form-control" id="annee_debut_poste" name="date_debut_poste">
									<option value="<?php echo date("Y") ?>"<?php if($annee_debut_poste == date("Y")){echo "selected";}?>><?php echo date("Y") ?></option>
									<option value="<?php echo date("Y")+1 ?>"<?php if($annee_debut_poste == date("Y")+1){echo "selected";}?>><?php echo date("Y")+1 ?></option>
									<option value="<?php echo date("Y")+2 ?>"<?php if($annee_debut_poste == date("Y")+2){echo "selected";}?>><?php echo date("Y")+2 ?></option>
									<option value="<?php echo date("Y")+3 ?>"<?php if($annee_debut_poste == date("Y")+3){echo "selected";}?>><?php echo date("Y")+3 ?></option>
								</select>
							</div>
							<div class="col-sm-2">
								<select class="form-control" id="h_debut_poste" name="date_debut_poste">
									<?php
									$heure_debut_poste = $dps['heure_debut_poste'];
									$m_debut_poste = substr($heure_debut_poste,-2);
									$h_debut_poste = substr($heure_debut_poste,0,2);
								$i = 00;
								while($i <= 23){
									if($i == $h_debut_poste){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="m_debut_poste" name="date_debut_poste">
									<?php 
								$i = 00;
								while($i <= 59){
									if($i == $m_debut_poste){
										echo "<option value='".$i."' selected>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
										$i++;
										}
								?>
								</select>
							</div>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_fin" class="col-sm-4 control-label">Date et heure de fin du poste</label>
							<div class="col-sm-6">
								<select class="form-control" id="jour_fin_poste" name="date_fin_poste">
									<?php
									$date_fin_poste = $dps['dps_fin_poste'];
									$jour_fin_poste = substr($date_fin_poste,-2);
									$mois_fin_poste = substr($date_fin_poste,5,7);
									$annee_fin_poste = substr($date_fin_poste,0,4);
								$i = 1;
								while($i <= 31){
									if($i == $jour_fin_poste){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="mois_fin_poste" name="date_fin_poste">
									<option value="1" <?php if($mois_fin_poste == 1){echo "selected";}?>>Janvier</option>
									<option value="2" <?php if($mois_fin_poste == 2){echo "selected";}?>>Février</option>
									<option value="3" <?php if($mois_fin_poste == 3){echo "selected";}?>>Mars</option>
									<option value="4" <?php if($mois_fin_poste == 4){echo "selected";}?>>Avril</option>
									<option value="5" <?php if($mois_fin_poste == 5){echo "selected";}?>>Mai</option>
									<option value="6" <?php if($mois_fin_poste == 6){echo "selected";}?>>Juin</option>
									<option value="7" <?php if($mois_fin_poste == 7){echo "selected";}?>>Juillet</option>
									<option value="8" <?php if($mois_fin_poste == 8){echo "selected";}?>>Août</option>
									<option value="9" <?php if($mois_fin_poste == 9){echo "selected";}?>>Septembre</option>
									<option value="10" <?php if($mois_fin_poste == 10){echo "selected";}?>>Octobre</option>
									<option value="11" <?php if($mois_fin_poste == 11){echo "selected";}?>>Novembre</option>
									<option value="12" <?php if($mois_fin_poste == 12){echo "selected";}?>>Décembre</option>
								</select>
								<select class="form-control" id="annee_fin_poste" name="date_fin_poste">
									<option value="<?php echo date("Y") ?>"<?php if($annee_fin_poste == date("Y")){echo "selected";}?>><?php echo date("Y") ?></option>
									<option value="<?php echo date("Y")+1 ?>"<?php if($annee_fin_poste == date("Y")+1){echo "selected";}?>><?php echo date("Y")+1 ?></option>
									<option value="<?php echo date("Y")+2 ?>"<?php if($annee_fin_poste == date("Y")+2){echo "selected";}?>><?php echo date("Y")+2 ?></option>
									<option value="<?php echo date("Y")+3 ?>"<?php if($annee_fin_poste == date("Y")+3){echo "selected";}?>><?php echo date("Y")+3 ?></option>
								</select>
							</div>
							<div class="col-sm-2">
								<select class="form-control" id="h_fin_poste" name="date_fin_poste">
									<?php
									$heure_fin_poste = $dps['heure_fin_poste'];
									$m_fin_poste = substr($heure_fin_poste,-2);
									$h_fin_poste = substr($heure_fin_poste,0,2);
								$i = 00;
								while($i <= 23){
									if($i == $h_fin_poste){
								echo "<option value='".$i."' selected>".$i."</option>";
								}else{
									echo "<option value='".$i."'>".$i."</option>";
								}
								$i++;
								}
								?>
								</select>
								<select class="form-control" id="m_fin_poste" name="date_fin_poste">
									<?php 
								$i = 00;
								while($i <= 59){
									if($i == $m_fin_poste){
										echo "<option value='".$i."' selected>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
										$i++;
										}
								?>
								</select>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Nombre de secouristes / moyens logistiques <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="nb_ce" class="col-sm-4 control-label">Chef(s) d'équipe</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_ce" name="nb_ce" placeholder="00" value="<?php echo $dps['cei'];?>">
									</div>
									<label for="nb-pse2" class="col-sm-4 control-label">PSE2</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_pse2" name="nb_pse2" placeholder="00" value="<?php echo $dps['PSE2'];?>">
									</div>
									<label for="nb_pse1" class="col-sm-4 control-label">PSE1</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_pse1" name="nb_pse1" placeholder="00" value="<?php echo $dps['PSE1'];?>">
									</div>
									<label for="nb_psc1" class="col-sm-4 control-label">PSC1</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_psc1" name="nb_psc1" placeholder="00" value="<?php echo $dps['PSC1'];?>">
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="vpsp_transport" class="col-sm-4 control-label">VPSP transport</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vpsp_transport" name="vpsp_transport" placeholder="00" value="<?php echo $dps['vpsp'];?>">
									</div>
									<label for="vpsp_soin" class="col-sm-4 control-label">VPSP soin</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vpsp_soin" name="vpsp_soin" placeholder="00" value="<?php echo $dps['vpsp_soin'];?>">
									</div>
									<label for="vl" class="col-sm-4 control-label">Véhicule Léger</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vl" name="vl" placeholder="00" value="<?php echo $dps['vl'];?>">
									</div>
									<label for="tente" class="col-sm-4 control-label">Tente</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="tente" name="tente" placeholder="00" value="<?php echo $dps['tente'];?>">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="local" class="col-sm-4 control-label">Local</label>
									<div class="col-sm-8">
										<select class="form-control" id="local" name="local">
											<option value="false" <?php if($dps['local'] == true){ echo "selected";}?>>Non</option>
											<option value="true" <?php if($dps['local'] == false){ echo "selected";}?>>Oui</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="supplement" class="col-sm-4 control-label">Moyens humains / logistiques supplémentaires</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="supplement" name="supplement" placeholder="entrer ici tout moyen supplémentaire" value="<?php echo $dps['moyen_supp'];?>">
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Moyens médicaux / structures</div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="medecin_asso" class="col-sm-4 control-label">Nombre médecin associatif</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="medecin_asso" name="medecin_asso" placeholder="00" value="<?php echo $dps['med_asso'];?>">
									</div>
									<label for="medecin_autre" class="col-sm-4 control-label">Nombre médecin autre</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="medecin_autre" name="medecin_autre" placeholder="00" value="<?php echo $dps['med_autre'];?>">
									</div>
									<label for="medecin_appartenance" class="col-sm-4 control-label">Appartenance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="medecin_appartenance" name="medecin_appartenance" placeholder="Appartenance" value="<?php echo $dps['medecin'];?>">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="infirmier_asso" class="col-sm-4 control-label">Nombre d'infirmier associatif</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="infirmier_asso" name="infirmier_asso" placeholder="00" value="<?php echo $dps['inf_asso'];?>">
									</div>
									<label for="infirmier_autre" class="col-sm-4 control-label">Nombre d'infirmier autre</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="infirmier_autre" name="infirmier_autre" placeholder="00" value="<?php echo $dps['inf_autre'];?>">
									</div>
									<label for="infirmier_appartenance" class="col-sm-4 control-label">Appartenance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="infirmier_appartenance" name="infirmier_appartenance" placeholder="Appartenance" value="<?php echo $dps['infirmier'];?>">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="samu" class="col-sm-4 control-label">SAMU</label>
									<div class="col-sm-2">
										<select class="form-control" id="samu" name="samu">
											<option value="0" <?php if($dps['samu'] == "0"){ echo "selected";}?>>Ni informé, ni présent</option>
											<option value="1" <?php if($dps['samu'] == "1"){ echo "selected";}?>>Informé, non présent</option>
											<option value="2" <?php if($dps['samu'] == "2"){ echo "selected";}?>>Informé et présent</option>
										</select>
									</div>
									<label for="bspp_sdis" class="col-sm-4 control-label">SDIS / BSPP</label>
									<div class="col-sm-2">
										<select class="form-control" id="bspp_sdis" name="bspp_sdis">
											<option value="0" <?php if($dps['pompier'] == "0"){ echo "selected";}?>>Ni informé, ni présent</option>
											<option value="1" <?php if($dps['pompier'] == "1"){ echo "selected";}?>>Informé, non présent</option>
											<option value="2" <?php if($dps['pompier'] == "2"){ echo "selected";}?>>Informé et présent</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Justificatif du dispositif mis en place</h3>
					</div>
					<div class="panel-body">
						<textarea class="form-control" rows="5" id="justificatif" name="justificatif" placeholder="Indiquer tout justificatif sur les moyens, structures, etc. ou toute information utile pour la bonne gestion administrative du poste." ><?php echo $dps['justif_poste'];?></textarea>
					</div>
				</div>
<?php
				echo "<input type='hidden' name='year' value='".$dps['annee_poste']."'>";
				echo "<input type='hidden' name='code_commune' value='".$dps['commune_ris']."'>";
				echo "<input type='hidden' name='num_cu' value='".$dps['num_cu']."'>";
?>
				
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning">Mettre à jour</button>
				    </div>
				</div>
			</form>
			
			
		<?php }if ($_SESSION['privilege'] == "user") { ?>
  		<strong>En tant qu'utilisateur simple vous ne pouvez pas effectuer d'actions</strong> <?php }?>
</div>
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>
<?php include 'footer.php'; ?>
</body>
</html>

