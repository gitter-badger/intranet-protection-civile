<?php
	if (isset($_POST['inputPermissionTitle'])) {
		$title=$_POST['inputPermissionTitle'];
	}
	else {
		$title=$rbac->Permissions->getTitle($permissionID);
	}
	if (isset($_POST['inputPermissionDescription'])) {
		$description=$_POST['inputPermissionDescription'];
	}
	else {
		$description=$rbac->Permissions->getDescription($permissionID);
	}
	if (isset($_POST['updatePermission'])) {	
		$check_query = "SELECT ID FROM rbac_permissions WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$permission = mysqli_num_rows($verif);		
		if ($permission){
			$genericError = "Une permission du même titre existe déjà (".$title.")";
			$updateErrorTitle = "Une permission du même titre existe déjà (".$title.")";
		}
		
		else if (in_array($title, $undeletablePermissions)) { 
			$genericError = "Il est interdit de mettre à jour la permission '".$title."'";
			$updateErrorTitle = "Il est interdit de mettre à jour la permission '".$title."'";
		}
		else {
			$perm_id = $rbac->Permissions->edit($permissionID, $title, $description);
			if (!$perm_id){
				$genericError = "Echec de la mise à jour (ID=".$permissionID.")";
			}
			else {
				$genericSuccess = "Permission mise à jour (".$title.")";	
			}
		}
	}
?>