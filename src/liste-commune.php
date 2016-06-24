<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Liste des communes</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include 'header.php'; ?>
	<div class="container">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des communes</h3>
		</div>
		<div class="panel-body">
		<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Code</th>
				<th>Commune</th>
				<th>Rattachement</th>
				<th>Adresse</th>
				<th>CP</th>
				<th>Ville</th>
				<th>Téléphone</th>
				<th>Adresse e-mail</th>
				<th>Modifier</th>
			</tr>
			<?php
			$query = "SELECT nomcode,nom,numero,rat_commune,adresse,codepost,ville,tel,mail FROM commune ORDER BY numero ASC";
			$listecommune_result = mysqli_query($link, $query);
			while($listecommune = mysqli_fetch_array($listecommune_result)){
				if ($listecommune["rat_commune"] == "0"){
					echo "<tr class='danger'>";
				}elseif ($listecommune["numero"] != $listecommune["rat_commune"]){
					echo "<tr class='warning'>";
				}else{
					echo "<tr class='success'>";
				}
			echo "<td>";
			echo $listecommune["nomcode"];
			echo "</td>";
			if ($listecommune["rat_commune"] == "0"){
					echo "<td>";
					echo $listecommune["nom"];
				}elseif ($listecommune["numero"] != $listecommune["rat_commune"]){
					echo "<td>";
					echo $listecommune["nom"];
				}else{
					echo "<td colspan='2'>";
					echo $listecommune["nom"];
				}
			echo "</td>";
			if ($listecommune["rat_commune"] == "0"){
					echo "<td>";
					$rat_commune = $listecommune["rat_commune"];
					$rat_query = "SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$rat_commune";
					$rat_result = mysqli_query($link, $rat_query);
					$rattach = mysqli_fetch_array($rat_result);
					echo $rattach["nom_commune"];
				}elseif ($listecommune["numero"] != $listecommune["rat_commune"]){
					echo "<td>";
					$rat_commune = $listecommune["rat_commune"];
					$rat_query = "SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$rat_commune";
					$rat_result = mysqli_query($link, $rat_query);
					$rattach = mysqli_fetch_array($rat_result);
					echo $rattach["nom_commune"];
				}else{
				}
			echo "</td><td>";
			echo $listecommune["adresse"];
			echo "</td><td>";
			echo $listecommune["codepost"];
			echo "</td><td>";
			echo $listecommune["ville"];
			echo "</td><td>";
			echo $listecommune["tel"];
			echo "</td><td>";
			echo $listecommune["mail"]."@protectioncivile92.org";
			echo "</td><td>";
			?>
			<form role="form" action="modifier-commune.php" method="post">
			<?php
			echo "<input type='hidden' name='modifier' value='".$listecommune["numero"]."'>";
			echo "<button type='submit' class='btn btn-warning'>Modifier</button></form>";
			echo "</td>";
			echo "</tr>";
			}
			?>
		</table>
		</div>
		</div>
		</div>
	</div>
	<?php } include 'footer.php'; ?>
	</body>
	</html>