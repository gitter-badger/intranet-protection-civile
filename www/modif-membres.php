<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>

<?php
// script de traitement

// ------ SUPPRESSION D'UN UTILISATEUR --------
// on fait la requête sur tous les utilisateurs de la base
mysql_select_db($database_dbprotect, $dbprotect);
$query_users = "SELECT * FROM $tablename_dbprotect ORDER BY nom ASC"; // ORDER BY renvoi les données triées (ici par nom croissant)
$users = mysql_query($query_users, $dbprotect) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if (isset($_POST['suppr'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	$id = $_POST['suppr'];
    $query_user = mysql_query("SELECT * FROM $tablename_dbprotect WHERE id_user='$id'", $dbprotect);
    $row_verif = mysql_fetch_assoc($query_user);
    $privilege = $row_verif['privilege'];
    $query_admin = mysql_query("SELECT * FROM $tablename_dbprotect WHERE privilege = 'admin'", $dbprotect);
    $admin = mysql_num_rows($query_admin);
    
    if ($privilege == 'admin' && $admin == 2) {
        $errorsuppr = "Vous ne pouvez pas supprimer cet administrateur (code erreur : ErSup-01)";
        //exit;
    }
    else {
        $delete_user = sprintf("DELETE FROM $tablename_dbprotect WHERE id_user='$id'");
        mysql_select_db($database_dbprotect, $dbprotect);
        $result = mysql_query($delete_user, $dbprotect) or die(mysql_error());
        $successsuppr = "Membre supprimé avec succès";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modification d'un membre</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
				<div class="panel-heading">Liste des membres</div>
				<div class="panel-body">
				  
				  
				  <div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Login</th>
						<th>Commune</th>
						<th>Modifier</th>
						<th>Supprimer</th>
					</tr>
					<?php 
					$tableaumembres = mysql_query("SELECT * FROM $tablename_dbprotect");
					while($membres = mysql_fetch_array($tableaumembres)) {
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
					$reqliste = mysql_query("SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$commune");
					$rattach = mysql_fetch_array($reqliste);
					echo $rattach["nom_commune"];
					echo "</td>";
					echo "<td>";
					echo "<form action='membre.php' method='post' accept-charset='utf-8'>";
					echo "<input type='hidden' name='modifier' value='".$membres['id_user']."'>";
					echo "<button type='submit' class='btn btn-warning'>modifier</button>";
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