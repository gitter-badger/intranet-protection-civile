<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>

<?php
// script de traitement

// ------ SUPPRESSION D'UN UTILISATEUR --------
// on fait la requête sur tous les utilisateurs de la base
$query_users = "SELECT * FROM $tablename_dbprotect ORDER BY nom ASC";
$users = mysqli_query($link, $query_users);
$row_users = mysqli_fetch_assoc($users);

if (isset($_POST['suppr'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	$id = $_POST['suppr'];
	$query_id = "SELECT * FROM $tablename_dbprotect WHERE id_user='$id'";
	$query_user = mysqli_query($link, $query_id);
	$row_verif = mysqli_fetch_assoc($query_user);
    $privilege = $row_verif['privilege'];
	$query_admin = "SELECT * FROM $tablename_dbprotect WHERE privilege = 'admin'";
	$query_admin_req = mysqli_query($link, $query_admin);
    $admin = mysqli_num_rows($query_admin_req);
    
    if ($privilege == 'admin' && $admin == 2) {
        $errorsuppr = "Vous ne pouvez pas supprimer cet administrateur (code erreur : ErSup-admin)";
        //exit;
    }
    else {
		$delete_user = "DELETE FROM $tablename_dbprotect WHERE id_user='$id'";
		mysqli_query($link,$delete_user);
        $successsuppr = "Membre supprimé avec succès";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modification d'un membre</title>
	<meta http-equiv="Content-Type" content="text/html";>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">

				  <?php if (!empty($errorsuppr)){
					echo "<div class='alert alert-danger' role='alert'>";
					echo $errorsuppr;
					echo "</div>";
				}
				if (!empty($successsuppr)){
					echo "<div class='alert alert-success' role='alert'>";
					echo $successsuppr;
					echo "</div>";
				}?>
				  
				  <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Liste des membres</h3>
				</div>
				<div class="panel-body">
				  
				  
				  <div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Login</th>
						<th>Commune</th>
						<th>Modifier</th>
						<th>Mot de passe</th>
						<th>Supprimer</th>
					</tr>
					<?php 
					$query = "SELECT * FROM $tablename_dbprotect ORDER by nom ASC";
					$tableaumembres = mysqli_query($link, $query);
					while($membres = mysqli_fetch_array($tableaumembres)){
					echo "<tr><td>";
					echo $membres["nom"];
					echo "</td>";
					echo "<td>";
					echo $membres["prenom"];
					echo "</td>";
					echo "<td>";
					echo $membres["login"];
					echo "</td>";
					echo "<td>";
					$commune = $membres["commune"];
					$query = "SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$commune";
					$reqliste = mysqli_query($link, $query);
					$rattach = mysqli_fetch_array($reqliste);
					echo $rattach["nom_commune"];
					echo "</td>";
					echo "<td>";
					echo "<form action='membre.php' method='post' accept-charset='utf-8'>";
					echo "<input type='hidden' name='modifier' value='".$membres['id_user']."'>";
					echo "<button type='submit' class='btn btn-warning'>Modifier</button>";
					echo "</form>";
					echo "</td><td>";
					echo "<form action='' method='post' accept-charset='utf-8'>";
					echo "<input type='hidden' name='reinit' value='".$membres['id_user']."'>";
					echo "<button type='submit' class='btn btn-warning disabled'>Réinitialiser</button>";
					echo "</form>";
					echo "</td><td>";
					echo "<form action='' method='post' accept-charset='utf-8'>";
					echo "<input type='hidden' name='suppr' value='".$membres['id_user']."'>";
					echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
					echo "</form>";
					echo "</td></tr>";
				}
					?>
					</table>
					</div>
					
				</div>
				<div class="panel-footer"><a class="btn btn-default" role="button" href="membres.php">Ajouter un membre</a></div>
				</div>
</div>
<?php } include 'footer.php'; ?>
</body>
</html>