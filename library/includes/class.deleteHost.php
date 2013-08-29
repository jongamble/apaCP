<?php 

/**
 * The Delete Virtual Hosts Class
 * 
 * This is the class we will use when we no longer want
 * to keep one of our virtual hosts around. These methods
 * are not reversable. If you run them, and you want
 * the data back, you will have to recreate it from
 * scratch. You've been warned.
 *
 * @author Jon Gamble <jon@trimarksolutions.com>
 * @copyright 2013 Trimark Solutions
 * @license All Rights Reserved
 */

class DeleteHost 
{
	// Set up private variables for each host creation
	private $_siteName;
	private $_domainName;
	private $_userName;
	private $_userPass;
	private $_folderName;
	private $_clientType;
	
	public function __construct($siteName, $domainName, $userName, $userPass, $folderName, $clientType)
	{
		$this->_siteName = $siteName;
		$this->_domainName = $domainName;
		$this->_userName = $userName;
		$this->_userPass = $userPass;
		$this->_folderName = $folderName;
		$this->_clientType = $clientType;
	}

	public function deleteUser()
	{
		$output = 'userdel -r '.$this->_userName."<br/>";
		//$output = shell_exec('useradd -p'.$_userPass.' '.$_userName);
		return $output;
	}

	public function deleteVirtualHost()
	{
		// Find Virtual Host File and delete it
	}

	public function disableSite()
	{
		$output = 'a2dissite '.$this->_domainName;
		return $output;
	}

	public function restartApache()
	{
		$output = 'service apache2 restart';
		return $output;
	}
}

?>