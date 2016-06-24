<?php
require('../fpdf/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFillColor(237,242,247);
$pdf->SetDrawColor(237,242,247);
$pdf->Rect(0,0,210,35,'FD');
$pdf->Image("../img/logo.png",10,5,24,24);
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','B',11);
$pdf->Text(118.2,7,"ROTECTION     IVILE  DES     AUTS  DE     EINE");
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(255,127,0);
$pdf->Text(114.2,7.2,"P");
$pdf->Text(142.3,7.2,"C");
$pdf->Text(167.8,7.15,"H");
$pdf->Text(191.4,7.2,"S");
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','',8);
$pdf->Text(145.3,18,"32 boulevard des oiseaux - 92700 COLOMBES");
$pdf->Text(151.3,22,"Tel : 01 47 72 80 33 - Fax : 01 74 18 09 13");
$pdf->Text(99.6,26,"E-mail : operationnel@protectioncivile92.org - Site Web : www.protectioncivile92.org");
$pdf->SetFont('Arial','B',9);
$pdf->Text(10.5,33.2,"DIRECTION DEPARTEMENTALE DES OPERATIONS");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',11);
$pdf->Text(10.5,40,"Ouverture d'un Point d'Alerte et de Premiers Secours (PAPS)");
$pdf->Text(10.5,45.5,"Antenne de Courbevoie, Neuilly-sur-seine, La Garenne-Colombes");


// Début des cadres
// Position du cadre COA : X = 168 --- Y = 41
$pdf->SetFont('Arial','B',11); 
$pdf->SetXY(168,41);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(32,5.3,"92-15-COU-080",1,1,"C");
$pdf->SetFont('Arial','',7); 
$pdf->SetTextColor(0,0,0);
$pdf->Text(168, 40, "Certificat Original d'Affiliation");

$pdf->SetLineWidth(0.3) ;
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(13,53,148);
$pdf->SetXY(10,50);
$pdf->Cell(50,5,"Organisateur",1,0,"","true");
$pdf->Rect(10, 55, 190, 28) ;

$pdf->SetXY(10,87);
$pdf->Cell(50,5,"Nature de la manifestation",1,0,"","true");
$pdf->Rect(10, 92, 190, 16) ;

$pdf->SetXY(10,112);
$pdf->Cell(50,5,"Grille d'évaluation des risques",1,0,"","true");
$pdf->Rect(10, 117, 190, 30) ;

$pdf->SetXY(10,151);
$pdf->Cell(50,5,"Configuration du DPS",1,0,"","true");
$pdf->Rect(10, 156, 190, 52) ;

$pdf->SetXY(10,212);
$pdf->Cell(50,5,"Justification du DPS",1,0,"","true");
$pdf->Rect(10, 217, 190, 10) ;

$pdf->SetXY(10,231);
$pdf->Cell(50,5,"Cadre réservé à l'administration",1,0,"","true");
$pdf->Rect(10, 236, 190, 11) ;
//fin des cadres

//Organisateur
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Text(11, 58, "Nom :");
$pdf->Text(11, 62, "Représentée par :");  
$pdf->Text(11, 66, "Qualité de :"); 
$pdf->Text(11, 70, "Adresse :"); 
$pdf->Text(11, 74, "Téléphone :"); 
$pdf->Text(70, 74, "Fax :"); 
$pdf->Text(11, 78, "E-mail :");
$pdf->SetFont('Arial','',8);
$pdf->Text(40, 58, "Association Passé Présent (A.P.P.)");
$pdf->Text(40, 62, "Michèle TELLIER");  
$pdf->Text(40, 66, "Organisatrice de la Révolution Française"); 
$pdf->Text(40, 70, "13 Avenue du Chat blanc sur la grande branche en chêne clair - 92345 Cormeilles En Parisis Sur Marne de la Seine"); 
$pdf->Text(40, 74, "+1 783-780-1345"); 
$pdf->Text(80, 74, "01 02 03 04 05"); 
$pdf->Text(40, 78, "directeur-adj-informatique@protectioncivile92.org");
$pdf->Text(11, 82, "Aucun dossier n'a été déposé en préfecture.");

//Nature manifestation
$pdf->SetFont('Arial','B',8); 
$pdf->Text(11, 95, "Nom / nature :");
$pdf->Text(11, 99, "Activité / descriptif :");
$pdf->Text(11, 103, "Lieux précis :");
$pdf->SetFont('Arial','',8);
$pdf->Text(40, 95, "Combats Kata et karaté : championnats départementaux 2015");
$pdf->Text(40, 99, "Sport / Karaté");  
$pdf->Text(40, 103, "13 Avenue du Chat blanc sur la grande branche en chêne clair - 92345 Cormeilles En Parisis Sur Marne de la Seine"); 
$pdf->Text(11, 107, "La manifestation se déroule le 04-10-2015 de 08H00 à 19H00"); 

//RIS
$pdf->SetFont('Arial','B',8); 
$pdf->Text(11, 120, "Acteurs :");
$pdf->Text(70, 120, "Spectateurs :"); 
$pdf->Text(180, 120, "P1 :"); 
$pdf->Text(11, 124, "Activité du rassemblement :"); 
$pdf->Text(11, 128, "Accessibilité et environnement :"); 
$pdf->Text(11, 136, "Délai d'intervention des secours publics :"); 
$pdf->Text(180, 124, "P2 :");
$pdf->Text(180, 128, "E1 :");
$pdf->Text(180, 136, "E2 :");
$pdf->Text(11, 142, "Indice total de risque :");
$pdf->Text(70, 142, "Effectif pondéré du public :");
$pdf->Text(11, 146, "Type de poste :");
$pdf->Text(180, 142, "RIS :"); 
$pdf->SetFont('Arial','',8); 
$pdf->Text(45, 120, "250000");
$pdf->Text(90, 120, "250000"); 
$pdf->Text(187, 120, "500000");
$pdf->Text(187, 124, "0,40");
$pdf->Text(187, 128, "0,40");
$pdf->Text(187, 136, "0,40");
$pdf->Text(45, 142, "0,80");
$pdf->Text(110, 142, "500000"); 
$pdf->Text(187, 142, "124");
$pdf->Text(45, 146, "Point d'Alerte et de Premiers secours (PAPS)");
$pdf->SetFont('Arial','',7); 
$pdf->Text(70, 124, "Public debout (spectacle avec public dynamique, danse féria, spectacle de rue, etc.)"); 
$pdf->Text(70, 128, "Espace naturels : surfaces Supérieur ou égal à 5 ha.");
$pdf->Text(70, 132, "Progression des secours rendue difficile par la présence du public"); 
$pdf->Text(70, 136, "Entre 20 minutes et 30 minutes"); 

//Configuration du DPS
$pdf->SetFont('Arial','',8);
$pdf->Text(11, 159, "Le Dispositif Prévisionnel de Secours sera activé du 04-10-2015 à 07H30 au 05-10-2015 à 18H00.");
$pdf->Text(11, 163, "La durée du Dispositif Prévionnel de Secours est de 34H30.");
$pdf->SetFont('Arial','B',8);
$pdf->Text(11, 167, "Nombre de secouristes :");
$pdf->Text(70, 167, "PSC1 :");
$pdf->Text(120, 167, "PSE1 :");
$pdf->Text(70, 171, "PSE2 :");
$pdf->Text(120, 171, "Chef D'équipe :");
$pdf->Text(11, 175, "Nombre de VPSP :");
$pdf->Text(70, 175, "Transport :");
$pdf->Text(120, 175, "Poste de soins :");
$pdf->Text(11, 179, "Autre :");
$pdf->Text(70, 179, "Véhicule Léger :");
$pdf->Text(120, 179, "Tente :");
$pdf->Text(180, 179, "Tente :");
$pdf->Text(11, 183, "Moyens humains / logistiques supplémentaires :");
$pdf->Text(11, 191, "Moyens médicaux / structures :");
$pdf->Text(11, 195, "Médecins :");
$pdf->Text(50, 195, "Associatifs :");
$pdf->Text(90, 195, "Autre :");
$pdf->Text(120, 195, "Appartenance :");
$pdf->Text(11, 199, "Infirmiers :");
$pdf->Text(50, 199, "Associatifs :");
$pdf->Text(90, 199, "Autre :");
$pdf->Text(120, 199, "Appartenance :");
$pdf->Text(11, 203, "Autres structures sur place :");
$pdf->SetFont('Arial','',8);
$pdf->Text(100, 167, "12");
$pdf->Text(150, 167, "124");
$pdf->Text(100, 171, "784");
$pdf->Text(150, 171, "207");
$pdf->Text(100, 175, "12");
$pdf->Text(150, 175, "124");
$pdf->Text(100, 179, "784");
$pdf->Text(150, 179, "207");
$pdf->Text(190, 179, "Non");
$pdf->Text(11, 187, "Lorem ipsum dolor sit amet...");
$pdf->Text(28, 195, "3");
$pdf->Text(70, 195, "3");
$pdf->Text(103, 195, "3");
$pdf->Text(143, 195, "Médecins Sans Frontières");
$pdf->Text(28, 199, "3");
$pdf->Text(70, 199, "3");
$pdf->Text(103, 199, "3");
$pdf->Text(143, 199, "Médecins Sans Frontières");
$pdf->Text(52, 203, "Le SAMU est informé et non-présent sur le poste de secours.");
$pdf->Text(52, 207, "La BSPP n'est ni informé ni présente sur le poste de secours.");

$pdf->SetFont('Arial','',8);
$pdf->Text(11, 250, "Le Directeur Local des Opérations");
$pdf->Text(11, 254, "Antenne de Courbevoie, Neuilly, La garenne colombes");
$pdf->Text(11, 258, "Nicolas Lethellier");
$pdf->Text(11, 262, "Le 13-10-2015");


$pdf->Text(120, 250, "Le Directeur Départemental des Opérations");
$pdf->Text(120, 254, "Protection Civile des Hauts-de-Seine");
$pdf->Text(120, 258, "Par intérim : Pascal Mallet");
$pdf->Text(120, 262, "Le 18-10-2015");
$pdf->Image("../img/rod92.png",167,260,30,15);
$pdf->Image("../img/tampon.png",110,262,50,15);

$pdf->SetFillColor(243,133,49);
$pdf->SetDrawColor(243,133,49);
$pdf->Rect(12,278,186,0.6,'FD');
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','',8);
$pdf->Text(22,283,"N° SIRET 325 625 739 00041 - N° APE 8559B - Déclaration en Préfecture N° W922002223 - Association régie par la loi de 1901");
$pdf->Text(28,288,"Membre de la Fédération Nationale de Protection Civile, Association agrée de sécurité civile - reconnue d'utilité publique");

$pdf->Output();
?>