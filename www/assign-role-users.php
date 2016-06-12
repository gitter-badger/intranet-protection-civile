<?php
	include 'securite.php';
	require_once('connexion.php');
	require_once ('PhpRbac/src/PhpRbac/Rbac.php');
	// use PhpRbac\Rbac;
	$rbac = new PhpRbac\Rbac();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Affectation des rôles</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>

<body>

<?php include 'header.php'; ?>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li><a href="/role-manage.php">Gestion des utilisateurs</a></li>
	<li class="active">Attributions de rôles</li>
</ol>

<!-- Submits form using the relevant permission -->
<script type="text/javascript">
	function send(rID) {
		document.getElementById('roleID').value=rID;
		document.forms["roleuser"].submit();
	}
</script>


<!-- Common -->
<?php 
	$userID = str_replace("'","", $_POST['userID']);
	if($userID == ""){
		$userUpdateError = "Aucun utilisateur défini";
	}
	else {
		$check_query = "SELECT ID, last_name, first_name FROM users WHERE ID='$userID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$user = mysqli_fetch_assoc($verif);
		$userCount = mysqli_num_rows($verif);		
		if (!$user){
			$userUpdateError = "L'utilisateur en question n'existe pas (ID=$userID)";
		}
	}
	if(!empty($userUpdateError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$userUpdateError."</div>";
	}
	else {
		$userFirstName=$user["first_name"];
		$userLastName=$user["last_name"];
?>


	<!-- Update a user's roles : Controller -->
	<?php
		if (isset($_POST['roleID'])){
			$roleID = str_replace("'","", $_POST['roleID']);
			if($roleID == ""){
				$genericUpdateError = "Impossible de mettre à jour un rôle inconnu";
			}
			else{
				$check_query = "SELECT ID FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
				$verif = mysqli_query($link, $check_query);
				$row_verif = mysqli_fetch_assoc($verif);
				$role = mysqli_num_rows($verif);		
				if (!$role){
					$genericUpdateError = "Le rôle en question n'existe pas";
				}
				else {
					$roleTitle=$rbac->Roles->getTitle($roleID);
					$check_query = "SELECT id_user FROM membres WHERE id_user='$userID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
					$verif = mysqli_query($link, $check_query);
					$row_verif = mysqli_fetch_assoc($verif);
					$user = mysqli_num_rows($verif);		
					if (!$user){
						$genericUpdateError = "L'utilisateur en question n'existe pas";
					}
					else {
						if ($rbac->Users->hasRole($roleTitle, $userID)) {
							$isDone = $rbac->Users->unassign($roleTitle, $userID);
						}
						else {
							$isDone = $rbac->Users->assign($roleTitle, $userID);
						}
						if (!$isDone){
							$genericUpdateError = "Echec de la mise à jour ('".$roleTitle."')";
						}
						else {
							$genericUpdateSuccess = "Rôle mis à jour avec la permission '".$roleTitle."'";	
						}
					}
				}
			}
		}
	?>

	<!-- Page content container -->
	<div class="container">
		

		<!-- Update user's roles : Operation status indicator -->
		<?php
			if (!empty($genericUpdateError)){
				echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericUpdateError."</div>";
			} elseif (!empty($genericUpdateSuccess)){
				echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericUpdateSuccess."</div>";
			}
			
		?>

		<h2>Modifier les rôles de '<?php echo $userFirstName." ".$userLastName ?>'</h2>


		<!-- Update a user's roles : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Rôles associés à l'utilisateur</h3>
			</div>
			<div class="panel-body">
				<form id="roleuser" class="form-horizontal" action='assign-role-users.php' method='post' accept-charset='utf-8'>
					<input type="hidden" name="userID" value="<?php echo $userID;?>">
					<input type="hidden" name="roleID" id="roleID" value="undefined">
				
					Les changements se font directement en cliquant sur les boutons. 
					<br /> <br />

					<?php 
						$query = "SELECT ID, Title, Description FROM rbac_roles ORDER by Title ASC";
						$roles = mysqli_query($link, $query);
						while($role = mysqli_fetch_array($roles)) { 
							$roleID=$role["ID"];
							$roleTitle=$role["Title"];
							$roleDescription=$role["Description"];
							
							if ($rbac->Users->hasRole($roleID, $userID)) {
								?>
								<button type="button" class="btn btn-default btn-xs active" title="<?php echo $roleDescription;?>" onClick="send(<?php echo $roleID;?>)"><?php echo $roleTitle;?></button>
								<?php
							}
							else {
								?>
								<button type="button" class="btn btn-default btn-xs" title="<?php echo $roleDescription;?>" onClick="send(<?php echo $roleID;?>)"><?php echo $roleTitle;?></button>
								<?php
							}

						} ?>
						<br /> <br />


					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<a class="btn btn-info" href="user-view.php" role="button">Retour à la liste des utilisateurs</a>
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