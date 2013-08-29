<?php

include_once('../includes/class.database.php');
$db = new Database();
$db->connect();
	
$post_content = array();
	$post_content['site_name'] = stripslashes(trim($_POST['site_name']));
	$post_content['domain_name'] = stripslashes(trim($_POST['domain_name']));
	$post_content['user_name'] = stripslashes(trim($_POST['user_name']));
	$post_content['user_pass'] = stripslashes(trim($_POST['user_pass']));
	$post_content['folder_name'] = stripslashes(trim($_POST['folder_name']));
	$post_content['client_type'] = stripslashes(trim($_POST['client_type']));

$result = $db->insert(
	'virtualHosts', 
	array(
		'',
		$post_content['site_name'],
		$post_content['domain_name'],
		$post_content['user_name'],
		$post_content['user_pass'],
		$post_content['folder_name'],
		$post_content['client_type'],
		'true'
	)
);
$lastRecord = mysql_insert_id();
$echo = $db->select('virtualHosts', '*' ,'id = '.$lastRecord);
$dbResults = $db->getResult();
echo json_encode($dbResults);
?>