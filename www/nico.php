<?php
require_once ('PhpRbac/src/PhpRbac/Rbac.php');
?>
	
	<head>
	<title>nico</title>
	
</head>

<body>

<?php echo date("H:i:s");

use PhpRbac\Rbac;
$rbac = new Rbac();

// Create a Permission
//$perm_id = $rbac->Permissions->add('delete_posts', 'Can delete forum posts');

// Create a Role
//$role_id = $rbac->Roles->add('forum_moderator', 'User can moderate forums');


// Get Entity Id's
//$perm_id = $rbac->Permissions->returnId('delete_posts');

//$role_id = $rbac->Roles->returnId('forum_moderator');
//$role_title = $rbac->Roles->getTitle($role_id);
//$role_desc = $rbac->Roles->getDescription($role_id);

$perm_descriptions = array(
    'Can delete users',
    'Can edit user profiles',
    'Can view users'
);

$rbac->Permissions->addPath('/delete_users/edit_users/view_users', $perm_descriptions);

// Assign Permission to Role
//$rbac->assign($role_id, $perm_id);

// Assign Role to User (The UserID is provided by the application's User Management System)
//$rbac->Users->assign($role_id, 2);

echo '<br />fait : role '.$role_id.' ('.$role_title.') : = '.$role_desc;

?>

<br />
fini
</body>
</html>
