<?php
	if (isset($_POST['addRole'])){
		$title = str_replace("'","", $_POST['inputRoleTitle']);
		$description = str_replace("'","", $_POST['inputRoleDescription']);
		if($title == ""){
			$genericError = "Le titre du rôle est obligatoire";
			$createErrorTitle = "Le titre du rôle est obligatoire";
		}
		else{
			$check_query = "SELECT ID FROM rbac_roles WHERE Title='$title'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$role = mysqli_num_rows($verif);		
			if ($role){
				$genericError = "Un rôle du même titre existe déjà";
				$createErrorTitle = "Un rôle du même titre existe déjà";
			}
			else {
				$perm_id = $rbac->Roles->add($title, $description);
				if (!isset($perm_id) || $perm_id==-1){
					$genericError = "Echec de la création (ID=".$perm_id.")";
				}
				else {
					$genericSuccess = "Rôle correctement ajouté : ".$title." (ID=".$perm_id.")";	
				}
			}
		}
	}
?>