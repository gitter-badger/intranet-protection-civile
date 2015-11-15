<?php
	include 'securite.php';
	require_once('connexion.php');
	require_once ('PhpRbac/src/PhpRbac/Rbac.php');
	use PhpRbac\Rbac;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modifier un rôle</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>

<body>

	<?php include 'header.php'; ?>
	<?php $undeletableRoles=array("Admin"); ?>

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="#">Administration</a></li>
		<li class="active">Modification de rôle</li>
	</ol>



	<!-- Update role : Controller -->
	<?php
		if (isset($_POST['roleID'])){
			$id = str_replace("'","", $_POST['roleID']);
			if($id == ""){
				$genericUpdateError = "Impossible de mettre à jour un rôle inconnu";
			}
			else{
				$check_query = "SELECT ID FROM rbac_roles WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);		
				if (!$role){
					$genericUpdateError = "Le rôle en question n'existe pas";
				}
				else {
					$rbac = new PhpRbac\Rbac();
					if (isset($_POST['inputRoleTitle'])) {
						$title=$_POST['inputRoleTitle'];
					}
					else {
						$title=$rbac->Roles->getTitle($id);
					}
					if (isset($_POST['inputRoleDescription'])) {
						$description=$_POST['inputRoleDescription'];
					}
					else {
						$description=$rbac->Roles->getDescription($id);
					}
					if (isset($_POST['updateRole'])) {	
						$check_query = "SELECT ID FROM rbac_roles WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
						$verif = mysqli_query($link, $check_query);
						$row_verif = mysqli_fetch_assoc($verif);
						$role = mysqli_num_rows($verif);		
						if ($role){
							$genericUpdateError = "Un rôle du même titre existe déjà (".$title.")";
							$updateErrorTitle = "Un rôle du même titre existe déjà (".$title.")";
						}
						
						else if (in_array($title, $undeletableRoles)) { 
							$genericUpdateError = "Il est interdit de mettre à jour le rôle '".$title."'";
							$updateErrorTitle = "Il est interdit de mettre à jour le rôle '".$title."'";
						}
						else {
							$perm_id = $rbac->Roles->edit($id, $title, $description);
							if (!$perm_id){
								$genericUpdateError = "Echec de la mise à jour (ID=".$id.")";
							}
							else {
								$genericUpdateSuccess = "Rôle mis à jour (".$title.")";	
							}
						}
					}
				}
			}
		}
	?>



	<!-- Update role : display form -->
	<div class="container">
		<?php
			if (!empty($genericUpdateError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericUpdateError."</div>";
			} elseif (!empty($genericUpdateSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericUpdateSuccess."</div>";
			}
		?>

		<h2>Modifier un rôle</h2>
		<form class="form-horizontal" action='role-edit.php' method='post' accept-charset='utf-8'>
			<div class="panel panel-default">
				<input type="hidden" name="updateRole">
				<input type="hidden" name="roleID" value="<?php echo $id;?>">
				<div class="panel-heading">
					<h3 class="panel-title">Informations à mettre à jour</h3>
				</div>
				<div class="panel-body">

					<?php if (!empty($updateErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputRoleTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="Directeur Local des Opérations" value="<?php echo $title;?>">
							</div>
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputRoleTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="Directeur Local des Opérations" value="<?php echo $title;?>">
							</div>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputRoleDescription" class="col-sm-4 control-label">Nouvelle description</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleDescription" name="inputRoleDescription" placeholder="Décrire l'utilité du rôle" value="<?php echo $description;?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php if (empty($genericUpdateSuccess)){ ?>
								<a class="btn btn-default" href="role-manage.php" role="button">Annuler - Retour à la liste</a>
							<?php } ?>
							<button type="submit" class="btn btn-warning">Mettre à jour</button>
							<?php if (isset($_POST['updateRole']) && !empty($genericUpdateSuccess)) { ?>
								<a class="btn btn-success" href="role-manage.php" role="button">J'ai terminé ! Retour à la liste</a>
							<?php } ?>
					    </div>
					</div>
				</div>
			</div>
		</form>
	</div>


<?php include 'footer.php'; ?>
</body>
</html>