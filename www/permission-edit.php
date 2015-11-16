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
	<title>Modifier une permission</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>

<body>

<?php include 'header.php'; ?>
<?php $undeletablePermissions=array("creer permission", "voir permission"); ?>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/permission-manage.php">Gestion des permissions</a></li>
	<li class="active">Modification</li>
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


	<!-- Update permission : Controller -->
	<?php
		if (isset($_POST['inputPermissionTitle'])) {
			$title=$_POST['inputPermissionTitle'];
		}
		else {
			$title=$rbac->Permissions->getTitle($id);
		}
		if (isset($_POST['inputPermissionDescription'])) {
			$description=$_POST['inputPermissionDescription'];
		}
		else {
			$description=$rbac->Permissions->getDescription($id);
		}
		if (isset($_POST['updatePermission'])) {	
			$check_query = "SELECT ID FROM rbac_permissions WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$permission = mysqli_num_rows($verif);		
			if ($permission){
				$genericUpdateError = "Une permission du même titre existe déjà (".$title.")";
				$updateErrorTitle = "Une permission du même titre existe déjà (".$title.")";
			}
			
			else if (in_array($title, $undeletablePermissions)) { 
				$genericUpdateError = "Il est interdit de mettre à jour la permission '".$title."'";
				$updateErrorTitle = "Il est interdit de mettre à jour la permission '".$title."'";
			}
			else {
				$perm_id = $rbac->Permissions->edit($id, $title, $description);
				if (!$perm_id){
					$genericUpdateError = "Echec de la mise à jour (ID=".$id.")";
				}
				else {
					$genericUpdateSuccess = "Permission mise à jour (".$title.")";	
				}
			}
		}
	?>



	<!-- Page content container -->
	<div class="container">
		

		<!-- Update permission : Operation status indicator -->
		<?php
			if (!empty($genericUpdateError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericUpdateError."</div>";
			} elseif (!empty($genericUpdateSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericUpdateSuccess."</div>";
			}
		?>

		<h2>Modifier la permission '<?php echo $permissionTitle ?>'</h2>


		<!-- Update permission : display form -->			
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action='permission-edit.php' method='post' accept-charset='utf-8'>
					<input type="hidden" name="updatePermission">
					<input type="hidden" name="permissionID" value="<?php echo $permissionID;?>">

					<?php if (!empty($updateErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputPermissionTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="Visualiser DPS" value="<?php echo $title;?>">
							</div>
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputPermissionTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="Visualiser DPS" value="<?php echo $title;?>">
							</div>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputPermissionDescription" class="col-sm-4 control-label">Nouvelle description</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputPermissionDescription" name="inputPermissionDescription" placeholder="Décrire l'utilité de la permission" value="<?php echo $description;?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php if (empty($genericUpdateSuccess)){ ?>
								<a class="btn btn-default" href="permission-manage.php" role="button">Annuler - Retour à la liste</a>
							<?php } ?>
							<button type="submit" class="btn btn-warning">Mettre à jour</button>
							<?php if (isset($_POST['updatePermission']) && !empty($genericUpdateSuccess)) { ?>
								<a class="btn btn-success" href="permission-manage.php" role="button">J'ai terminé ! Retour à la liste</a>
							<?php } ?>
					    </div>
					</div>
				</form>	
			</div>	
		</div>

	</div>

<?php
	}
?>

<?php include 'footer.php'; ?>
</body>
</html>