<?php

$dept = $_POST['departement'];
$year = $_POST['year'];
$num_cu = $_POST['num_cu'];
$code_commune = $_POST['code_commune'];

$nom_organisation = $_POST['nom_organisation'];
$nom_organisation = mysqli_real_escape_string($link, $nom_organisation);
$represente_par = $_POST['represente_par'];
$represente_par = mysqli_real_escape_string($link, $represente_par);
$qualite = $_POST['qualite'];
$qualite = mysqli_real_escape_string($link, $qualite);
$adresse = $_POST['adresse'];
$adresse = mysqli_real_escape_string($link, $adresse);
$telephone = $_POST['telephone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$deja_pref = $_POST['deja_pref'];

$nom_nature = $_POST['nom_nature'];
$nom_nature = mysqli_real_escape_string($link, $nom_nature);
$activite_descriptif = $_POST['activite_descriptif'];
$activite_descriptif = mysqli_real_escape_string($link, $activite_descriptif);
$lieu_precis = $_POST['lieu_precis'];
$lieu_precis = mysqli_real_escape_string($link, $lieu_precis);
$jour_debut = $_POST['jour_debut'];
if($jour_debut < 10){
	$jour_debut = "0".$jour_debut;
}
$mois_debut = $_POST['mois_debut'];
$annee_debut = $_POST['annee_debut'];
$date_debut = $annee_debut."-".$mois_debut."-".$jour_debut;
$h_debut = $_POST['h_debut'];
if($h_debut < 10){
	$h_debut = "0".$h_debut;
}
$m_debut = $_POST['m_debut'];
if($m_debut < 10){
	$m_debut = "0".$m_debut;
}
$heure_debut = $h_debut.$m_debut;
$jour_fin = $_POST['jour_fin'];
if($jour_fin < 10){
	$jour_fin = "0".$jour_fin;
}
$mois_fin = $_POST['mois_fin'];
$annee_fin = $_POST['annee_fin'];
$date_fin = $annee_fin."-".$mois_fin."-".$jour_fin;
$h_fin = $_POST['h_fin'];
if($h_fin < 10){
	$h_fin = "0".$h_fin;
}
$m_fin = $_POST['m_fin'];
if($m_fin < 10){
	$m_fin = "0".$m_fin;
}
$heure_fin = $h_fin.$m_fin;
$departement = $_POST['departement'];
$prix = $_POST['prix'];

$spectateurs = $_POST['spectateurs'];
$participants = $_POST['participants'];
$activite = $_POST['activite'];
$environnement = $_POST['environnement'];
$delai = $_POST['delai'];
$commentaire_ris = $_POST['commentaire_ris'];
$commentaire_ris = mysqli_real_escape_string($link, $commentaire_ris);

$p1_spec = $spectateurs;
$p1_part = $participants;
$p1 = $p1_spec + $p1_part;
if($activite == "1"){$p2 = 0.25;}elseif($activite == "2"){$p2 = 0.35;}elseif($activite == "3"){$p2 = 0.35;}else{$p2 = 0.40;}
if($environnement == "1"){$e1 = 0.25;}elseif($environnement == "2"){$e1 = 0.35;}elseif($environnement == "3"){$e1 = 0.35;}else{$e1 = 0.40;}
if($delai == "1"){$e2 = 0.25;}elseif($delai == "2"){$e2 = 0.35;}elseif($delai == "3"){$e2 = 0.35;}else{$e2 = 0.40;}
$i = $p2 + $e1 + $e2;
if($p1 <= 100000){$p = $p1;}else{
$p = 100000 + (($p1 - 100000)/2);}
$ris = $i * $p / 1000;
if($ris <= "1.125"){$type_dps = "0";}elseif($ris <= "12"){$type_dps = "1";}elseif($ris <= "36"){$type_dps = "2";}else{$type_dps = "3";}
$p2 = $activite;
$e1 = $environnement;
$e2 = $delai;



$jour_debut_poste = $_POST['jour_debut_poste'];
if($jour_debut_poste < 10){
	$jour_debut_poste = "0".$jour_debut_poste;
}
$mois_debut_poste = $_POST['mois_debut_poste'];
$annee_debut_poste = $_POST['annee_debut_poste'];
$date_debut_poste = $annee_debut_poste."-".$mois_debut_poste."-".$jour_debut_poste;
$h_debut = $_POST['h_debut_poste'];
if($h_debut_poste < 10){
	$h_debut_poste = "0".$h_debut_poste;
}
$m_debut_poste = $_POST['m_debut_poste'];
if($m_debut_poste < 10){
	$m_debut_poste = "0".$m_debut_poste;
}
$heure_debut_poste = $h_debut_poste.$m_debut_poste;
$jour_fin_poste = $_POST['jour_fin_poste'];
if($jour_fin_poste < 10){
	$jour_fin_poste = "0".$jour_fin_poste;
}
$mois_fin_poste = $_POST['mois_fin_poste'];
$annee_fin_poste = $_POST['annee_fin_poste'];
$date_fin_poste = $annee_fin_poste."-".$mois_fin_poste."-".$jour_fin_poste;
$h_fin_poste = $_POST['h_fin_poste'];
if($h_fin_poste < 10){
	$h_fin_poste = "0".$h_fin_poste;
}
$m_fin_poste = $_POST['m_fin_poste'];
if($m_fin_poste < 10){
	$m_fin_poste = "0".$m_fin_poste;
}
$heure_fin_poste = $h_fin_poste.$m_fin_poste;
$nb_ce = $_POST['nb_ce'];
$nb_pse2 = $_POST['nb_pse2'];
$nb_pse1 = $_POST['nb_pse1'];
$nb_psc1 = $_POST['nb_psc1'];
$vpsp_transport = $_POST['vpsp_transport'];
$vpsp_soin = $_POST['vpsp_soin'];
$vl = $_POST['vl'];
$tente = $_POST['tente'];
$local = $_POST['local'];
$supplement = $_POST['supplement'];
$supplement = mysqli_real_escape_string($link, $supplement);
$medecin_asso = $_POST['medecin_asso'];
$medecin_autre = $_POST['medecin_autre'];
$medecin_appartenance = $_POST['medecin_appartenance'];
$medecin_appartenance = mysqli_real_escape_string($link, $medecin_appartenance);
$infirmier_asso = $_POST['infirmier_asso'];
$infirmier_autre = $_POST['infirmier_autre'];
$infirmier_appartenance = $_POST['infirmier_appartenance'];
$infirmier_appartenance = mysqli_real_escape_string($link, $infirmier_appartenance);
$samu = $_POST['samu'];
$bspp_sdis = $_POST['bspp_sdis'];
$justificatif = $_POST['justificatif'];
$justificatif = mysqli_real_escape_string($link, $justificatif);
?>