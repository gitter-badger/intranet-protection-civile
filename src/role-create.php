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
	<title>Créer un rôle</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>

<body>

<?php include 'header.php'; ?>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-view.php">Gestion des rôles</a></li>
	<li class="active">Création</li>
</ol>



<!-- Create a new role : Controller -->
<?php include 'functions/controller/role-create-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Update role : Operation status indicator -->
	<?php include 'functions/operation-status-indicator.php'; ?>

	<h2>Gestion des roles</h2>


	<!-- Create a role : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Création d'un rôle</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" action='' method='post' accept-charset='utf-8'>
				<input type="hidden" id="wish" name="addRole">
			

				<?php if (!empty($createErrorTitle)){ ?>
					<div class="form-group has-error has-feedback">
						<label for="inputRoleTitle" class="col-sm-4 control-label">Titre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="ex: Directeur Local des Opérations" value="<?php echo $title;?>">
						</div>
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" />
						<span id="inputError2Status" class="sr-only">(error)</span>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label for="inputRoleTitle" class="col-sm-4 control-label">Titre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputRoleTitle" name="inputRoleTitle" aria-describedby="inputError2Status" placeholder="ex: Directeur Local des Opérations">
						</div>
					</div>
				<?php } ?>

				<div class="form-group">
					<label for="inputRoleDescription" class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputRoleDescription" name="inputRoleDescription" placeholder="Description ?"
						<?php
							if (isset($_POST['addRole']) && isset($_POST['genericError'])) {
								echo "value='$description'";
							}
						?>
						/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<?php if (empty($genericSuccess)){ ?>
							<a class="btn btn-default" href="role-view.php" role="button">Annuler - Retour à la liste</a>
						<?php } ?>
						<button type="submit" class="btn btn-success">Créer</button>
						<?php if (isset($_POST['addRole']) && !empty($genericSuccess)) { ?>
							<a class="btn btn-default" href="role-view.php" role="button">J'ai terminé ! Retour à la liste</a>
						<?php } ?>
				   </div>
				</div>
			</form>
		</div>
	</div>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
