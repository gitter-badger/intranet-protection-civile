<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ 
if(isset($_POST['id'])){
$id = $_POST['id'];
$query = "SELECT * FROM demande_dps WHERE id = $id";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);}
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Voir un DPS</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include 'header.php'; ?>
	<div class="container">

			<h2>DPS : <?php echo $dps['cu_complet'];?></h2>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Organisateur</h3>
					</div>
				<ul class="list-group">
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Nom de l'organisation</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['organisateur'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Représenté par</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['representant_org'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Qualité</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['qualite_org'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Adresse Postale</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['adresse_org'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Téléphone</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['tel_org'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Fax</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['fax_org'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Adresse e-mail</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['email_org'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Dossier déjà déposé en préfecture</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php if($dps['dossier_pref'] == true){echo "Oui";}else{ echo "Non";}?></p>
						</div>
					</div>
					</li>
				</ul>
				</div>
		
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Nature de la manifestation</h3>
					</div>
				<ul class="list-group">
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Nom / Nature de la manifestation</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['description_manif'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Activité / Descriptif</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['activite'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Lieu précis :</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['adresse_manif'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-4">
						<p>Date de début et fin</p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['dps_debut'];?></p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['dps_fin'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-4">
						<p>Heure de début et fin</p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['heure_debut'];?></p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['heure_fin'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Departement</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['dept'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Prix</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['prix'];?> Euros</p>
						</div>
					</div>
					</li>
				</ul>
			</div>
			
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Dimensionnement du poste</h3>
					</div>
				<ul class="list-group">
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Nombre de spectateurs</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['p1_spec'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Nombre de participants</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['p1_part'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Activité du rassemblement</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php $p2 = $dps['p2']; if($p2 == "1"){echo "Public assis (spectacle, réunion, restauration, etc.)";}elseif($p2 == "2"){ echo "Public debout (Exposition, foire, salon, exposition, etc.)";}elseif($p2 == "3"){echo "Public debout actif (Spectacle avec public statique, fête foraine, etc.)";}else{echo "Public debout à risque (public dynamique, danse, féria, carnaval, etc.)";}?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Environnement et accessibilité</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php $p2 = $dps['e1']; if($p2 == "1"){echo "Faible (Structure permanente, voies publiques, etc.)";}elseif($p2 == "2"){ echo "Public debout (Gradins, tribunes, mois de 2 hectares, etc.)";}elseif($p2 == "3"){echo "Public debout actif (Entre 2 et 5 hectares, autres conditions, etc.)";}else{echo "Public debout à risque (Brancardage > 600m, pas d'accès VPSP, etc.)";}?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Délai d'intervention des secours publics</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php $p2 = $dps['e2']; if($p2 == "1"){echo "Faible (Moins de 10 minutes)";}elseif($p2 == "2"){ echo "Modéré (Entre 10 et 20 minutes)";}elseif($p2 == "3"){echo "Moyen (Entre 20 et 30 minutes)";}else{echo "Elevé (Plus de 30 minutes)";}?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-6">
						<p>Commentaires concernant le RIS</p>
						</div>
						<div class="col-sm-6">
							<p class="bg-info"><?php echo $dps['comment_ris'];?></p>
						</div>
					</div>
					</li>
				</ul>
			</div>
			
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Configuration du dispositif prévisionnel de secours mis en place</h3>
					</div>
				<div class="panel-body">
				<ul class="list-group">
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-4">
						<p>Date de début et fin</p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['dps_debut_poste'];?></p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['dps_fin_poste'];?></p>
						</div>
					</div>
					</li>
					<li class="list-group-item">
					<div class="row">
						<div class="col-sm-4">
						<p>Heure de début et fin</p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['heure_debut_poste'];?></p>
						</div>
						<div class="col-sm-4">
							<p class="bg-info"><?php echo $dps['heure_fin_poste'];?></p>
						</div>
					</div>
					</li>
				</ul>
					<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">Nombre de secouristes / moyens logistiques</h4>
							</div>
						<ul class="list-group">
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-3">
								<p>Chef(s) d'équipe</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['cei'];?></p>
								</div>
								<div class="col-sm-3">
								<p>PSE2</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['PSE2'];?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
								<p>PSE1</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['PSE1'];?></p>
								</div>
								<div class="col-sm-3">
								<p>PSC1</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['PSC1'];?></p>
								</div>
							</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-3">
								<p>VPSP Transport</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['vpsp'];?></p>
								</div>
								<div class="col-sm-3">
								<p>VPSP Soin</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['vpsp_soin'];?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
								<p>VL</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['vl'];?></p>
								</div>
								<div class="col-sm-3">
								<p>Tente</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['tente'];?></p>
								</div>
							</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-4">
								<p>Local</p>
								</div>
								<div class="col-sm-8">
								<p class="bg-info"><?php if($dps['local'] =="0"){echo "Oui";}else{ echo "non";}?></p>
								</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-4">
								<p>Moyen(s) supplémentaire(s)</p>
								</div>
								<div class="col-sm-8">
								<p class="bg-info"><?php echo $dps['moyen_supp'];?></p>
								</div>
							</li>
						</ul>
					</div>
					
					<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Moyens médicaux / structures</h3>
							</div>
						<ul class="list-group">
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-3">
								<p>Nombre médecin associatif</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['med_asso'];?></p>
								</div>
								<div class="col-sm-3">
								<p>Nombre médecin autre</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['med_autre'];?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
								<p>Appartenance</p>
								</div>
								<div class="col-sm-8">
									<p class="bg-info"><?php echo $dps['medecin'];?></p>
								</div>
							</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-3">
								<p>Nombre d'infirmier associatif</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['inf_asso'];?></p>
								</div>
								<div class="col-sm-3">
								<p>Nombre d'infirmier autre</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php echo $dps['inf_autre'];?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
								<p>Appartenance</p>
								</div>
								<div class="col-sm-8">
									<p class="bg-info"><?php echo $dps['infirmer'];?></p>
								</div>
							</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-sm-3">
								<p>SAMU</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php if($dps['samu'] == "0"){echo "Ni informé, ni présent";}elseif($dps['samu'] == "1"){echo "Informé, non présent";}else{echo "Informé et présent";}?></p>
								</div>
								<div class="col-sm-3">
								<p>SDIS / BSPP</p>
								</div>
								<div class="col-sm-3">
									<p class="bg-info"><?php if($dps['pompier'] == "0"){echo "Ni informé, ni présent";}elseif($dps['pompier'] == "1"){echo "Informé, non présent";}else{echo "Informé et présent";}?></p>
								</div>
							</div>
						</ul>
					</div>
				</div>	
				</div>
				
				<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Justificatif du dispositif mis en place</h3>
						</div>
					<div class="panel-body">
							<p class="bg-info"><?php echo $dps['justif_poste'];?></p>
					</div>
				</div>
				
			</div>
		
	</div>
		<?php } include 'footer.php'; ?>
	</body>
	</html>