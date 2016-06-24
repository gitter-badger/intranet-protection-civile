<?php
include('securite.php');
require_once('connexion.php');
include 'functions/settings_mail_queries.php';


if (isset($_POST['suppr'])){
		if(delete_settings_mail($link, $_POST['suppr'])){
			$succes = "Paramètre mail supprimé avec succès";	
		}
}
if ($_SESSION['privilege'] !== "admin") {
	header("Location: accueil.php");
}
else{
	$page = 1;
	if(isset($_GET['page'])){
		$page = intval($_GET['page']);
	}
	$settingsCount = count_settings_mail($link);
	$settings = select_settings_mail($link, $page);
	$pages = ceil($settingsCount/50);
}



?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Liste des Paramètres Mail</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
	<?php include('header.php') ?>
	<div class="container">
<?php
	if (!empty($erreur)){
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$erreur."</div>";
	}elseif (!empty($succes)){
		echo "<div class='alert alert-success'><strong>Réussi</strong> : ".$succes."</div>";
	}
?>
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des Paramètres Mail</h3>
		</div>
		<div class="panel-body">
		<?php if($settingsCount ===0): ?>
			<div> aucun paramètre mail enregistré </div>
		<?php else: ?>
		<div class="table-responsive" style="vertical-align: middle;">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Nom</th>
				<th>Valeur</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			<?php foreach ($settings as $setting):?>
			<tr class='info'>
				<td><?php echo $setting['setting_name'] ?></td>
				<td><?php echo $setting['setting_value'] ?></td>
				<td><a href="modif-settings_mail.php?id=<?php echo $setting['ID'] ?>" class='btn btn-warning'>Modifier</a></td>
				<td>
					<form action="" method="post" accept-charset="utf-8"><input name="suppr" value="<?php echo $setting['ID'] ?>" type="hidden"><button type="submit" class="btn btn-danger">Supprimer</button></form>
				</td>
			</tr>	
			<?php endforeach;  ?>	
		</table>
		<div>
		<?php for ($i=1; $i < $pages+1; $i++) { ?> 
			<a href="<?php echo sprintf('%s?page=%s', $_SERVER['PHP_SELF'], $i) ?>" ><?php echo $i; ?></a>
		<?php } ?>
		</div>
		</div>
	<?php endif; ?>
	</div>
	<div class="panel-footer"><a class="btn btn-default" role="button" href="settings_mail.php">Ajouter un paramètre</a></div>
	</div>
	</div>
	

	</body>
	</html>
