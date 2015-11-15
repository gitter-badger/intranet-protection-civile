<?php
	include 'securite.php';
	require_once('connexion.php');
	require_once ('PhpRbac/src/PhpRbac/Rbac.php');
	use PhpRbac\Rbac;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion des rôles</title>
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
		<li class="active">Gestion des rôles</li>
	</ol>




	<!-- Create a new role : Controller -->
	<?php
		if (isset($_POST['addRole'])){
			$title = str_replace("'","", $_POST['inputRoleTitle']);
			$description = str_replace("'","", $_POST['inputRoleDescription']);
			if($title == ""){
				$genericCreateError = "Le titre du rôle est obligatoire";
				$createErrorTitle = "Le titre du rôle est obligatoire";
			}
			else{
				$check_query = "SELECT ID FROM rbac_roles WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);		
				if ($role){
					$genericCreateError = "Un rôle du même titre existe déjà";
					$createErrorTitle = "Un rôle du même titre existe déjà";
				}
				else {
					$rbac = new PhpRbac\Rbac();
					$perm_id = $rbac->Roles->add($title, $description);
					if (!isset($perm_id) || $perm_id==-1){
						$genericCreateError = "Echec de la création (ID=".$perm_id.")";
					}
					else {
						$genericCreateSuccess = "Rôle correctement ajouté : ".$title." (ID=".$perm_id.")";	
					}
				}
			}
		}
	?>


	<!-- Delete a role : Controller -->
	<?php
		if (isset($_POST['delRole'])){
			$id = str_replace("'","", $_POST['delRole']);
			if($id == ""){
				$genericDeleteError = "Impossible de supprimer un rôle inconnu";
			}
			else{
				$check_query = "SELECT ID, Title FROM rbac_roles WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);		
				if (!$role){
					$genericDeleteError = "Le rôle en question n'existe pas";
				}
				else {
					$rbac = new PhpRbac\Rbac();
					$roleTitle = $rbac->Roles->getTitle($id);
					if (in_array($roleTitle, $undeletableRoles)) { 
						$genericDeleteError = "Il est interdit de supprimer le rôle '".$roleTitle."'";
					}
					else {
						$perm_id = $rbac->Roles->remove($id, true);
						if (!$perm_id){
							$genericDeleteError = "Echec de la suppression (ID=".$id.")";
						}
						else {
							$genericDeleteSuccess = "Rôle correctement supprimé (".$roleTitle.")";	
						}
					}
				}
			}
		}
	?>


	<!-- Create a role : display form -->
	<div class="container">
		<?php
			if (!empty($genericCreateError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericCreateError."</div>";
			} elseif (!empty($genericCreateSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericCreateSuccess."</div>";
			}
		?>

		<h2>Gestion des roles</h2>
		<form class="form-inline" action='' method='post' accept-charset='utf-8'>
			<div class="panel panel-default">
				<input type="hidden" id="wish" name="addRole">
				<div class="panel-heading">
					<h3 class="panel-title">Création d'un rôle</h3>
				</div>
				<div class="panel-body">

					<?php if (!empty($createErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputRoleTitle" class="control-label">Titre</label>
							<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="ex: Directeur Local des Opérations" value="<?php echo $title;?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputRoleTitle" class="control-label">Titre</label>
							<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="ex: Directeur Local des Opérations">
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputRoleDescription" class="control-label">Description</label>
						<input type="text" class="form-control" id="inputRoleDescription" name="inputRoleDescription" placeholder="Description ?"
							<?php
								if (isset($_POST['addRole']) && isset($_POST['genericCreateError'])) {
									echo "value='$description'";
								}
							?>
						>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Créer</button>
					</div>
				</div>
			</div>
		</form>
	</div>



	<!-- List available roles -->
	<div class="container">
		<?php
			if (!empty($genericDeleteError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericDeleteError."</div>";
			} elseif (!empty($genericDeleteSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericDeleteSuccess."</div>";
			}
		?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Visualisation des rôles</h3>
			</div>
			<!-- <div class="panel-body"> -->
				<div class="table-responsive">
					<table class="table ">
						<tr>
							<th>ID</th>
							<th>Titre</th>
							<th>Description</th>
							<th>Modifier</th>
							<th>Permissions</th>
							<th>Supprimer</th>
						</tr>
						<?php 
						$query = "SELECT ID, Title, Description FROM rbac_roles ORDER by ID ASC";
						$roles = mysqli_query($link, $query);
						while($role = mysqli_fetch_array($roles)) { ?>
							<tr>
								<td>
									<?php echo $role["ID"]; ?>
								</td>
								<td>
									<?php echo $role["Title"]; ?>
								</td>
								<td>
									<?php echo $role["Description"]; ?>
								</td>
								<td>
									<form action='role-edit.php' method='post' accept-charset='utf-8'>
										<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
										<button type='submit' class='btn btn-warning'>Modifier</button>
									</form>
								</td>
								<td>
									<form action='role-permissions.php' method='post' accept-charset='utf-8'>
										<input type='hidden' name='roleID' value=<?php echo "'".$role['ID']."'"; ?> >
										<button type='submit' class='btn btn-warning'>Permissions</button>
									</form>
								</td>
								<td>
									<form action='' method='post' accept-charset='utf-8'>
										<input type='hidden' name='delRole' value=<?php echo "'".$role['ID']."'"; ?> >
										<?php if (in_array($role['Title'], $undeletableRoles)) { ?>
											<button type='submit' class='btn btn-danger' disabled='disabled'>Supprimer</button>
										<?php } else { ?>
											<button type='submit' class='btn btn-danger' onclick='return(confirm("Etes-vous sûr de vouloir supprimer le rôle?"));'>Supprimer</button>
										<?php }?>
									</form>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>
			<!-- </div> -->
		</div>		
	</div>

	<?php include 'footer.php'; ?>
</body>
</html>
