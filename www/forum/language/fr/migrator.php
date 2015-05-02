<?php
/**
*
* This file is part of the french language pack for the phpBB Forum Software package.
* This file is translated by phpBB-fr.com <http://www.phpbb-fr.com>
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'CONFIG_NOT_EXIST'					=> 'Le paramètre de configuration « %s » n’existe pas.',

	'GROUP_NOT_EXIST'					=> 'Le groupe « %s » n’existe pas.',

	'MIGRATION_APPLY_DEPENDENCIES'		=> 'Appliquer les dépendances de %s.',
	'MIGRATION_DATA_DONE'				=> 'Données installées : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Installation des données en cours : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_DATA_RUNNING'			=> 'Installation des données : %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> 'Migration déjà été effectuée avec succès (ignorée) : %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Une exception a été déclenchée pendant l’exécution d’une requête. Les modifications effectuées avant ce problème ont été annulées au mieux, mais vous devriez vérifier que votre forum ne comporte pas d’erreurs.',
	'MIGRATION_NOT_FULFILLABLE'			=> 'La migration « %1$s » n’est pas complète, il manque la migration « %2$s ».',
	'MIGRATION_NOT_VALID'				=> '%s n’est pas une migration valide.',
	'MIGRATION_SCHEMA_DONE'				=> 'Schéma installé : %1$s ; Durée : %2$.2f secondes',
	'MIGRATION_SCHEMA_RUNNING'			=> 'Installation du schéma : %s.',

	'MODULE_ERROR'						=> 'Une erreur est survenue pendant la création du module : %s',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Un fichier d’information de module requis est manquant : %2$s',
	'MODULE_NOT_EXIST'					=> 'Un module requis est manquant : %s',

	'PERMISSION_NOT_EXIST'				=> 'La permission « %s » n’existe pas.',

	'ROLE_NOT_EXIST'					=> 'Le modèle de permissions pour le rôle « %s » n’existe pas.',
));
