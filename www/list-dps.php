<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Liste des DPS</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include 'header.php'; ?>
	<div class="container">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des Dispositifs Prévisionnels de Secours</h3>
		</div>
		<div class="panel-body">
		<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Date</th>
				<th>Numéro CU</th>
				<th>DPT</th>
				<th>Type</th>
				<th>Description</th>
				<th>Validation</th>
				<th>Action</th>
			</tr>
		<?php
		$dpsperpage = 50;
		if(isset($_GET['commune'])){
		$commune = $_GET['commune'];
		$query = "SELECT id, commune_ris FROM demande_dps WHERE commune_ris = $commune";
		$number_dps = mysqli_query($link, $query);
		$row_cnt = mysqli_num_rows($number_dps);
		$numberpages=ceil($row_cnt/$dpsperpage);
		
		if(isset($_GET['page'])){
		$pagecurrent=intval($_GET['page']);
		if($pagecurrent>$numberpages){
		$pagecurrent=$numberpages;}}
		else{
		$pagecurrent=1;}
		$premiereEntree=($pagecurrent-1)*$dpsperpage;
		$query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt FROM demande_dps WHERE commune_ris = $commune ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
		$listedps_result = mysqli_query($link, $query);
		
		}else{
		$query = "SELECT id FROM demande_dps";
		$number_dps = mysqli_query($link, $query);
		$row_cnt = mysqli_num_rows($number_dps);
		$numberpages=ceil($row_cnt/$dpsperpage);
		
		if(isset($_GET['page'])){
		$pagecurrent=intval($_GET['page']);
		if($pagecurrent>$numberpages){
		$pagecurrent=$numberpages;}}
		else{
		$pagecurrent=1;}
		$premiereEntree=($pagecurrent-1)*$dpsperpage;
		$query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt FROM demande_dps ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
		$listedps_result = mysqli_query($link, $query);
		}
		while($listedps = mysqli_fetch_array($listedps_result)){
			if($listedps["valid_demande_rt"] == 0){
				$validation=false;
				$urlform = "edit-dps.php";
				$buttonclass = "btn btn-warning";
				$buttonmessage = "Modifier";
				echo "<tr class='warning'>";
			}else{
				$validation=true;
				$urlform = "show-dps.php";
				$buttonclass = "btn btn-success";
				$buttonmessage = "Acceder";
				echo "<tr class='success'>";
			}
		echo "<td>";
		echo $listedps["dps_debut_poste"];
		echo "</td><td>";
		echo $listedps["cu_complet"];
		echo "</td><td>";
		$dpt = $listedps["dept"];
		if($dpt != "92"){
		echo "<strong>".$dpt."</strong>";
		}else{
		echo $dpt;}
		echo "</td><td>";
		$type = $listedps["type_dps"];
		if($type == "0"){
		$type = "PAPS";
		}elseif($type == "1"){
		$type = "DPS-PE";
		}elseif($type == "2"){
		$type = "DPS-ME";
		}elseif($type == "3"){
		$type = "DPS-GE";}
		echo $type;
		echo "</td><td>";
		echo $listedps["description_manif"];
		echo "</td><td>";
		if($validation == false){
			echo "En attente";
		}else{
		echo $listedps["valid_demande_rt"];}
		echo "</td><td>";
		echo "<form role='form' action=".$urlform." method='post'>";
		echo "<input type='hidden' name='id' value='".$listedps["id"]."'>";
		echo "<button type='submit' class='".$buttonclass."'>".$buttonmessage."</button></form>";
		echo "</td></tr>";
		}
		?>
		</table>
		<nav>
		<ul class="pagination pagination-sm">
		<?php 
	for($i=1; $i<=$numberpages; $i++){
	?>
			<?php if($i==$pagecurrent){ ?>
			<li class="active"><a href="<?php echo $i; ?>"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
		<?php
		}else{
		if(isset($_GET['commune'])){
		$pageget = "?commune=".$commune."&page=".$i;}else{
		$pageget = "?page=".$i;}
		echo "<li><a href='list-dps.php".$pageget."'>".$i."</a></li>";
		}}
		?>
		</ul>
	</nav>
		</div>
	</div>
	</div>
	</div>
	<?php } include 'footer.php'; ?>
	</body>
	</html>