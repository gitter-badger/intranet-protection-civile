<?php
	include 'securite.php';
	require_once('connexion.php');
	require_once ('PhpRbac/src/PhpRbac/Rbac.php');
	use PhpRbac\Rbac;
	$rbac = new Rbac();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Utilisations de la permission</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>

<body>

<?php include 'header.php'; ?>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/permission-manage.php">Gestion des permissions</a></li>
	<li class="active">Utilisation</li>
</ol>

<!-- Common -->
<?php 
	$permissionID = str_replace("'","", $_POST['permissionID']);
	if($permissionID == ""){
		$rpermissionpdateError = "Aucune permission définie";
	}
	else {
		$check_query = "SELECT ID FROM rbac_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);		
		if (!$permission){
			$permissionUpdateError = "La permission en question n'existe pas";
		}
	}
	if(!empty($permissionUpdateError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$rpermissionUpdateError."</div>";
	}
	else {
		$permissionTitle=$rbac->Permissions->getTitle($permissionID);
?>

	
	<!-- Page content container -->
	<div class="container">

		<h2>Utilisation de la permission '<?php echo $permissionTitle ?>'</h2>


		<!-- Permission usage : Container -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Utilisations de cette permission</h3>
			</div>
			<div class="panel-body">

				<!-- Permission usage : See roles with permission -->
				<div class="panel panel-default">
					<div class="panel-heading">Rôles</div>
					<div class="panel-body">
						<?php 
							$query = "SELECT R.ID, R.Title FROM rbac_rolepermissions AS RP INNER JOIN rbac_roles AS R ON RP.RoleId=R.ID WHERE RP.PermissionId='$permissionID' ORDER BY R.Title" or die("Erreur lors de la consultation" . mysqli_error($link)); 
							$roles = mysqli_query($link, $query);
							while($role = mysqli_fetch_array($roles)) { 
								$roleID=$role["ID"];
								$roleTitle=$role["Title"];
								echo $roleTitle.", ";
							}
						?>
					</div>
				</div>

				<!-- Permission usage : See users with permission -->
				<div class="panel panel-default">
					<div class="panel-heading">Utilisateurs</div>
					<div class="panel-body">
						NE FONCTIONNE PAS POUR LE MOMENT (FONCTIONNALITE PAS DEVELOPPEE)
						<?php 
							$query = "SELECT U.ID, U.last_name, U.first_name FROM rbac_rolepermissions AS RP INNER JOIN users AS U ON RP.RoleId=R.ID WHERE RP.PermissionId='$permissionID' ORDER BY U.nom" or die("Erreur lors de la consultation" . mysqli_error($link)); 
							$users = mysqli_query($link, $query);
							while($user = mysqli_fetch_array($users)) { 
								$userID=$user["id_user"];
								$userFirstName=$user["prenom"];
								$userLastName=$user["nom"];
								echo $userFirstName." ".$userLastName.", ";
							}
						?>
					</div>
				</div>

			</div>

		</div>

	</div>

<?php
	}
?>

<?php include 'footer.php'; ?>
</body>
</html>