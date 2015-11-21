<?php
	if (!empty($genericError)){
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$genericError."</div>";
	} elseif (!empty($genericSuccess)){
		echo "<div class='alert alert-success'><strong>Effectué</strong> : ".$genericSuccess."</div>";
	}
?>