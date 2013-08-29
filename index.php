<?php 
	include_once('library/includes/class.database.php');
	include_once('library/includes/class.createHost.php');
	$db = new Database();
	$db->connect();
	if(isset($_POST['submit'])){
		$create = new createHost($_POST['site-name'],$_POST['domain-name'],$_POST['user-name'],$_POST['user-pass'],$_POST['folder-name'],$_POST['client-type']);
		if($create->validateInput() == 'false'){
			$createUserOutput = $create->createUser();
			$createFolderOutput = $create->createFolder();
			$enableSiteOut = $create->enableSite();
			$restartApacheOut = $create->restartApache();
		}
	}
	$db->select('virtualHosts');
	$dbResults = $db->getResult();
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apache Admin Panel</title>
	<link rel="stylesheet" href="library/css/screen.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="library/js/libs.js"></script>
    <script src="library/js/scripts.js"></script>
</head>
<body>
<header class="main-header">
	<div class="container">
		<h1 class="h1 col-12">Apache Admin Control Panel</h1>
	</div>
</header>
<section class="container">
	<article class="module create-new col-lg-4 col-sm-12">
		<header class="module-header">
			<h1 class="h2">Create a New Virtual Host</h1>
		</header>
		<section class="module-content">
			<form action="" method="POST" class="create-host">
				<label for="site-name" class="input-label">Site Name</label>
				<input type="text" name="site-name" placeholder="Site Name" id="site-name" class="input-text">
				<label for="domain-name" class="input-label">Fully Qualified Domain Name</label>
				<input type="text" name="domain-name" placeholder="example.com" id="domain-name" class="input-text">
				<label for="user-name" class="input-label">User Name</label>
				<input type="text" name="user-name" placeholder="User Name" id="user-name" class="input-text">
				<label for="user-pass" class="input-label">User Password</label>
				<input type="password" name="user-pass" placeholder="User Password" id="user-pass" class="input-text">
				<label for="folder-name" class="input-label">Folder Name</label>
				<input type="text" name="folder-name" placeholder="Folder Name" id="folder-name" class="input-text">
				<label for="client-type" class="input-label">Type of Client</label>
				<select name="client-type" id="client-type"  class="input-select">
					<option value="general-client">General Client</option>
					<option value="pharmacy">Pharmacy</option>
					<option value="trimark">Trimark Solutions</option>
					<option value="window-world">Window World</option>
					<option value="wordpress">Wordpress Client</option>
				</select>
				<input type="submit" name="submit" value="Submit" id="submit" class="input-submit">
			</form>
		</section>
	</article>
	<article class="module view-active col-lg-push-1 col-lg-7 col-sm-12">
		<header class="module-header">
			<h1 class="h2">View Active Virtual Hosts</h1>
		</header>
		<section class="module-content">
			<table class="active-hosts responsive">
				<tr class="active-hosts-headings">
					<th class="active-hosts-header">Site Name</th>
					<th class="active-hosts-header">Domain Name</th>
					<th class="active-hosts-header">User Name</th>
					<th class="active-hosts-header">Folder Name</th>
					<th class="active-hosts-header">Client Type</th>
					<th class="active-hosts-header">Active?</th>
					<th class="active-hosts-header">Actions</th>
				</tr>
				<?php include('library/includes/inc.activeHosts.php'); ?>

			</table>
		</section>
	</article>
	<article class="module test-output col-12">
		<header class="module-header">
			<h1 class="h2">Test Output</h1>
		</header>
		<section class="module-content">
			<p><?php echo $insertResult;?></p>
			<p><?php echo $createUserOutput;?></p>
			<p><?php echo $createFolderOutput;?></p>
			<p><?php echo $enableSiteOut;?></p>
			<p><?php echo $restartApacheOut;?></p>
		</section>
	</article>
</section>
</body>
</html>
