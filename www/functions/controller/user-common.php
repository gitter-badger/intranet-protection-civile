<?php 
	$userID = str_replace("'","", $_POST['userID']);

	if($userID == ""){
		$commonError = "Aucun utilisateur défini";
	}
	else {
		$check_query = "SELECT ID, last_name, first_name, mail, phone FROM users WHERE ID='$userID'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$verif = mysqli_query($link, $check_query);
		$row_verif = mysqli_fetch_assoc($verif);
		$user = mysqli_num_rows($verif);		
		if (!$user){
			$commonError = "Le rôle en question n'existe pas";
		}
	}
	
	if(!empty($commonError)) {
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$commonError."</div>";
	}
	else {
		$userLastName=$row_verif[''];
	}
?>