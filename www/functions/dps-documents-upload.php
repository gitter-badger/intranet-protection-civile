<?php
include '../securite.php';
require_once('../connexion.php');

	$tmp_file = $_FILES['image']['tmp_name'];
	$filename = $_FILES['image']['name'];
	$num_cu = $_POST['num_cu'];
	$cu = $_POST['cu'];
	$type = $_POST['type'];
	$antenne = $_POST['antenne'];
	$year = $_POST['year'];
	
	$path_parts = pathinfo($filename);
	if($path_parts['extension'] != "pdf"){exit;}
	
	
	if($type == "convention"){
	$filename = $cu."-CONV.pdf";
	}elseif($type == "risk"){
	$filename = $cu."-RISK.pdf";
	}elseif($type == "demande"){
	$filename = $cu."-DEM.pdf";}
	
	$year = date("Y");
	if($type == "autre"){
	$path = dirname(__DIR__)."/documents_dps/".$year."/".$antenne."/".$num_cu."/autre/";
	$pathtocreate = "../documents_dps/$year/$antenne/$num_cu/autre/";
	$security = fopen("../documents_dps/$year/index.html","w");
	fclose($security);
	$security = fopen("../documents_dps/$year/$antenne/index.html","w");
	fclose($security);
	$security = fopen("../documents_dps/$year/$antenne/$num_cu/index.html","w");
	fclose($security);
	$security = fopen("../documents_dps/$year/$antenne/$num_cu/autre/index.html","w");
	fclose($security);
	if ( ! is_dir($path)) {
	    mkdir($pathtocreate, 0755, true);
	}
	}else{
	$path = dirname(__DIR__)."/documents_dps/".$year."/".$antenne."/".$num_cu."/";
	$pathtocreate = "../documents_dps/$year/$antenne/$num_cu/";
	$security = fopen("../documents_dps/$year/index.html","w");
	fclose($security);
	$security = fopen("../documents_dps/$year/$antenne/index.html","w");
	fclose($security);
	$security = fopen("../documents_dps/$year/$antenne/$num_cu/index.html","w");
	fclose($security);
	if ( ! is_dir($path)) {
	    mkdir($pathtocreate, 0755, true);
	}}
	move_uploaded_file($tmp_file, $path.$filename);
	$data['status'] = 'done';
    echo json_encode($data);


?>