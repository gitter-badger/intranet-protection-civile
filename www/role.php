<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['role'] != "1") { header("Location: accueil.php"); }else{ ?>



<!DOCTYPE html>
<html>
<head>
	<title>Gestion des rôles</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
				  <div class="panel panel-default">
				<div class="panel-heading">Liste des rôles</div>
				<div class="panel-body">
				  
				  
				  <div class="table-responsive">
				<table class="table table-striped table-condensed table-bordered">
					<tr>
						<th>Nom</th>
						<th>Opé</th>
						<th>Gestion Opé</th>
						<th>Log</th>
						<th>Gestion Log</th>
						<th>For</th>
						<th>Gestion For</th>
						<th>ADPC</th>
						<th>ARS</th>
						<th>OPR</th>
						<th>Admin</th>
						<th>Sup Admin</th>
						<th>Supprimer</th>
					</tr>
					<?php 
					$query = "SELECT * FROM roles ORDER by id ASC";
					$tableau_role = mysqli_query($link, $query);
					while($role = mysqli_fetch_array($tableau_role)){
					echo "<tr><td>";
					echo $role["name"];
					echo "</td><td>";
					echo $role["op"];
					echo "</td><td>";
					echo $role["super_op"];
					echo "</td><td>";
					echo $role["log"];
					echo "</td><td>";
					echo $role["super_log"];
					echo "</td><td>";
					echo $role["for"];
					echo "</td><td>";
					echo $role["super_for"];
					echo "</td><td>";
					echo $role["adpc"];
					echo "</td><td>";
					echo $role["ars"];
					echo "</td><td>";
					echo $role["opr"];
					echo "</td><td>";
					echo $role["admin"];
					echo "</td><td>";
					echo $role["super_admin"];
					echo "</td><td>";
					echo "<form action='' method='post' accept-charset='utf-8'>";
					echo "<input type='hidden' name='suppr' value='".$role['id']."'>";
					echo "<button type='submit' class='btn btn-danger'>Suppr.</button>";
					echo "</form>";
					echo "</td></tr>";
				}
					?>
					</table>
					</div>
					
				</div>
				<div class="panel-footer"><a class="btn btn-default" role="button" href="edit-role.php">Ajouter ou modifier un rôle</a></div>
				</div>
</div>
<?php } include 'footer.php'; ?>
</body>
</html>