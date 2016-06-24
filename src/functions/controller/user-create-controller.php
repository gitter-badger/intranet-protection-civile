<?php
	if (isset($_POST['addUser'])){
		$lastName = str_replace("'","", $_POST['inputUserLastName']);
		$lastNameDB = strtolower(str_replace(" ","-", $lastName));
		$firstName = str_replace("'","", $_POST['inputUserFirstName']);
		$firstNameDB = strtolower(str_replace(" ","-", $firstName));
		$login = suppr_accents($firstNameDB.".".$lastNameDB);
		$pass1 = str_replace("'","", $_POST['inputUserPassword1']);
		$pass2 = str_replace("'","", $_POST['inputUserPassword2']);
		$passDB = sha1($pass1);
		$phone = str_replace("'","", $_POST['inputUserPhone']);
		$mail = $login."@protectioncivile92.org";
		$section = str_replace("'","", $_POST['inputUserSection']);

		if($lastName == ""){
			$genericError = "Le nom de famille est obligatoire";
			$createErrorLastName = "Le nom de famille est obligatoire";
		}
		if($lastName == ""){
			$genericError = "Le prénom est obligatoire";
			$createErrorFirstName = "Le prénom est obligatoire";
		}
		if($pass1 == ""){
			$genericError = "Le mot de passe est obligatoire";
			$createErrorPassword = "Le mot de passe est obligatoire";
		}
		if($pass1 !== $pass2){
			$genericError = "Les deux mots de passe ne concordent pas";
			$createErrorPassword = "Les deux mots de passe ne concordent pas";
		}
		if (empty($genericError)){
			$check_query = "SELECT ID FROM users WHERE mail='$mail'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$verif = mysqli_query($link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$user = mysqli_num_rows($verif);		
			if ($user){
				$genericError = "Un utilisateur avec la même adresse mail existe déjà (".$mail.")";
			}
			else {
				$add_user = "INSERT INTO users(pass, last_name, first_name, phone, mail, attached_section) VALUES ('$passDB', '$lastNameDB', '$firstNameDB', '$phone', '$mail', '$section')" or die("Impossible d'ajouter l'utilisateur dans la base de données" . mysqli_error($link));
				mysqli_query($link, $add_user);
				$genericSuccess = "Membre créé avec succès (".$mail.")";
			}
		}
	}
?>