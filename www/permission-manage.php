<?php
	include 'securite.php';
	require_once('connexion.php');
	require_once ('PhpRbac/src/PhpRbac/Rbac.php');
	use PhpRbac\Rbac;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion des permissions</title>
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
		<li class="active">Gestion des permissions</li>
	</ol>




	<!-- Create a new permission : Controller -->
	<?php
		if (isset($_POST['addPermission'])){
			$title = str_replace("'","", $_POST['inputPermissionTitle']);
			$description = str_replace("'","", $_POST['inputPermissionDescription']);
			if($title == ""){
				$genericCreateError = "Le titre de la permission est obligatoire";
				$createErrorTitle = "Le titre de la permission est obligatoire";
			}
			else{
				$check_query = "SELECT ID FROM rbac_permissions WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$permission = mysqli_num_rows($verif);		
				if ($permission){
					$genericCreateError = "Une permission du même titre existe déjà";
					$createErrorTitle = "Une permission du même titre existe déjà";
				}
				else {
					$rbac = new PhpRbac\Rbac();
					$perm_id = $rbac->Permissions->add($title, $description);
					if (!isset($perm_id) || $perm_id==-1){
						$genericCreateError = "Echec de la création (ID=".$perm_id.")";
					}
					else {
						$genericCreateSuccess = "Permission correctement ajoutée : ".$title." (ID=".$perm_id.")";	
					}
				}
			}
		}
	?>


	<!-- Delete a permission : Controller -->
	<?php
		if (isset($_POST['delPermission'])){
			$id = str_replace("'","", $_POST['delPermission']);
			if($id == ""){
				$genericDeleteError = "Impossible de supprimer une permission inconnue";
			}
			else{
				$check_query = "SELECT ID, Title FROM rbac_permissions WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$permission = mysqli_num_rows($verif);		
				if (!$permission){
					$genericDeleteError = "La permission en question n'existe pas";
				}
				else {
					$rbac = new PhpRbac\Rbac();
					$permissionTitle = $rbac->Permissions->getTitle($id);
					if (in_array($permissionTitle, $undeletablePermissions)) { 
						$genericDeleteError = "Il est interdit de supprimer la permission '".$permissionTitle."'";
					}
					else {
						$perm_id = $rbac->Permissions->remove($id, true);
						if (!$perm_id){
							$genericDeleteError = "Echec de la suppression (ID=".$id.")";
						}
						else {
							$genericDeleteSuccess = "Permission correctement supprimée (".$permissionTitle.")";	
						}
					}
				}
			}
		}
	?>


	<!-- Create a permission : display form -->
	<div class="container">
		<?php
			if (!empty($genericCreateError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericCreateError."</div>";
			} elseif (!empty($genericCreateSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericCreateSuccess."</div>";
			}
		?>

		<h2>Gestion des permissions</h2>
		<form class="form-inline" action='' method='post' accept-charset='utf-8'>
			<div class="panel panel-default">
				<input type="hidden" id="wish" name="addPermission">
				<div class="panel-heading">
					<h3 class="panel-title">Création d'une permission</h3>
				</div>
				<div class="panel-body">

					<?php if (!empty($createErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputPermissionTitle" class="control-label">Titre</label>
							<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="ex: Visualiser DPS" value="<?php echo $title;?>">
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputPermissionTitle" class="control-label">Titre</label>
							<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="ex: Visualiser DPS">
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputPermissionDescription" class="control-label">Description</label>
						<input type="text" class="form-control" id="inputPermissionDescription" name="inputPermissionDescription" placeholder="Description ?"
							<?php
								if (isset($_POST['addPermission']) && isset($_POST['genericCreateError'])) {
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



	<!-- List available permissions -->
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
				<h3 class="panel-title">Visualisation des permissions</h3>
			</div>
			<!-- <div class="panel-body"> -->
				<div class="table-responsive">
					<table class="table ">
						<tr>
							<th>ID</th>
							<th>Titre</th>
							<th>Description</th>
							<th>Modifier</th>
							<th>Supprimer</th>
						</tr>
						<?php 
						$query = "SELECT ID, Title, Description FROM rbac_permissions ORDER by ID ASC";
						$permissions = mysqli_query($link, $query);
						while($permission = mysqli_fetch_array($permissions)) { ?>
							<tr>
								<td>
									<?php echo $permission["ID"]; ?>
								</td>
								<td>
									<?php echo $permission["Title"]; ?>
								</td>
								<td>
									<?php echo $permission["Description"]; ?>
								</td>
								<td>
									<form action='permission-edit.php' method='post' accept-charset='utf-8'>
										<input type='hidden' name='permissionID' value=<?php echo "'".$permission['ID']."'"; ?> >
										<button type='submit' class='btn btn-warning'>Modifier</button>
									</form>
								</td>
								<td>
									<form action='' method='post' accept-charset='utf-8'>
										<input type='hidden' name='delPermission' value=<?php echo "'".$permission['ID']."'"; ?> >
										<?php if (in_array($permission['Title'], $undeletablePermissions)) { ?>
											<button type='submit' class='btn btn-danger' disabled='disabled'>Supprimer</button>
										<?php } else { ?>
											<button type='submit' class='btn btn-danger' onclick='return(confirm("Etes-vous sûr de vouloir supprimer la permission?"));'>Supprimer</button>
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


	<div class="checkbox">
		<label>
			<input type="checkbox"> Check me out
		</label>
	</div>	

	<?php include 'footer.php'; ?>
</body>
</html>
