<?php

// On charges les librairies principales (logger, etc...)
include __DIR__.'/../src/lib/logger.php';

// On active le logger
lib\logger\logger_register();

echo $a;

// Url demandé par le client
$uri = $_SERVER['REQUEST_URI'];

// On protège l'include contre les attaques par chemin relatifs
$uri = str_replace('..', '', $uri);

// On construit le chemin vers le fichier php
$pathPagePhp = __DIR__.'/../src/'.$uri; 

// Le page php existe
if (file_exists($pathPagePhp)) {
    // Alors on l'affiche
    include $pathPagePhp;
}
else
{
    // Dans le cas contraire on affiche une page par défaut
    // TODO : Prévoir une page 404
    echo 'La page demandée n\'existe pas. Retour vers <a href="/index.php">accueil</a>.';
    
    header('HTTP/1.0 404 Not Found');
    exit();
}