<?php

include_once('../includes/class.database.php');
//include_once('../includes/class.deleteHost.php');
//$host = new DeleteHost();
$db = new Database();
$db->connect();

$post_content = array();
$post_content['item_id'] = stripslashes(trim($_POST['item_id']));

$result = $db->delete(
	'virtualHosts', 
	'id = '.$post_content['item_id']
);

echo json_encode($result);

?>