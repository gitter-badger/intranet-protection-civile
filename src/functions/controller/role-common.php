<?php 
	$roleID = str_replace("'","", $_POST['roleID']);

	if($roleID == ""){
		$commonError = "Aucun rôle défini";
	}
	else {
		$check_query = "SELECT ID FROM rbac_roles WHERE ID='$roleID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);		
		if (!$role){
			$commonError = "Le rôle en question n'existe pas";
		}
	}
	
	if(!empty($commonError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$commonError."</div>";
	}
	else {
		$roleTitle=$rbac->Roles->getTitle($roleID);
	}
?>