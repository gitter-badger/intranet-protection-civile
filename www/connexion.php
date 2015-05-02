<?php
// paramètres de connexion
$hostname_dbprotect = "localhost";  // nom de votre serveur
$username_dbprotect = "root";       // nom d'utilisateur (root par défaut) !!! ATTENTION, en utilisant root, vos visiteurs ont tous les droits sur la base
$password_dbprotect = "root";           // mot de passe (aucun par défaut mais il est conseillé d'en mettre un)
$database_dbprotect = "ADPC";  // nom de votre base de données   
$tablename_dbprotect= "membres";    // nom de la table utilisée
$tablename_commune = "commune";		//liste des communes
$tablename_ratcommune = "rat_com";		//liste des rattachements aux communes
$tablename_ratmembre = "rat_membre";		//membres vis à vis des communes
$tablename_ratdepartement = "rat_dpt";		//membres vis à vis du département
//$dbprotect = mysql_connect($hostname_dbprotect, $username_dbprotect, $password_dbprotect) or trigger_error(mysql_err(),E_USER_ERROR);
$link = mysqli_connect($hostname_dbprotect,$username_dbprotect,$password_dbprotect,$database_dbprotect) or die("Error " . mysqli_error($link));
if (!mysqli_set_charset($link, "utf8")) {}
?>