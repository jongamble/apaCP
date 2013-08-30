<?php

include_once('../includes/class.database.php');
include_once('../includes/class.createHost.php');
$db = new Database();
$db->connect();

function cleanInput($input) {
	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	);

	$output = preg_replace($search, '', $input);
	return $output;
}

function sanitize($input) {
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize($val);
		}
	} else {
		if (get_magic_quotes_gpc()) {
			$input = stripslashes($input);
		}
		$input  = cleanInput($input);
		$output = mysql_real_escape_string($input);
	}
	return $output;
}

	

$post_content = array();
	$post_content['site_name'] = sanitize($_POST['site_name']);
	$post_content['domain_name'] = sanitize($_POST['domain_name']);
	$post_content['user_name'] = sanitize($_POST['user_name']);
	$post_content['user_pass'] = sanitize($_POST['user_pass']);
	$post_content['folder_name'] = sanitize($_POST['folder_name']);
	$post_content['client_type'] = sanitize($_POST['client_type']);

$create = new CreateHost($post_content['site-name'],$post_content['domain-name'],$post_content['user-name'],$post_content['user-pass'],$post_content['folder-name'],$post_content['client-type']);


	$createUserOutput = $create->createUser();
	$createFolderOutput = $create->createFolder();
	$enableSiteOut = $create->enableSite();
	$restartApacheOut = $create->restartApache();


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