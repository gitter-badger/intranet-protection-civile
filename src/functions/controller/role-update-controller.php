<?php
	if (isset($_POST['inputRoleTitle'])) {
		$title=$_POST['inputRoleTitle'];
	}
	else {
		$title=$rbac->Roles->getTitle($roleID);
	}
	if (isset($_POST['inputRoleDescription'])) {
		$description=$_POST['inputRoleDescription'];
	}
	else {
		$description=$rbac->Roles->getDescription($roleID);
	}
	if (isset($_POST['updateRole'])) {	
		$check_query = "SELECT ID FROM rbac_roles WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$role = mysqli_num_rows($verif);		
		if ($role){
			$genericError = "Un rôle du même titre existe déjà (".$title.")";
			$updateErrorTitle = "Un rôle du même titre existe déjà (".$title.")";
		}
		
		else if (in_array($title, $undeletableRoles)) { 
			$genericError = "Il est interdit de mettre à jour le rôle '".$title."'";
			$updateErrorTitle = "Il est interdit de mettre à jour le rôle '".$title."'";
		}
		else {
			$perm_id = $rbac->Roles->edit($roleID, $title, $description);
			if (!$perm_id){
				$genericError = "Echec de la mise à jour (ID=".$roleID.")";
			}
			else {
				$genericSuccess = "Rôle mis à jour (".$title.")";	
			}
		}
	}
?>