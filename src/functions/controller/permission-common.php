<?php 
	$permissionID = str_replace("'","", $_POST['permissionID']);

	if($permissionID == ""){
		$commonError = "Aucune permission définie";
	}
	else {
		$check_query = "SELECT ID FROM rbac_permissions WHERE ID='$permissionID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);		
		if (!$permission){
			$commonError = "La permission en question n'existe pas";
		}
	}
	
	if(!empty($commonError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$commonError."</div>";
	}
	else {
		$permissionTitle=$rbac->Permissions->getTitle($permissionID);
	}
?>