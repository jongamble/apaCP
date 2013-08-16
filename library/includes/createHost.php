<?php

/**
 * The Create Virtual Hosts Class
 * 
 * This is the class being used to set up a new website within Apache, 
 * creating the new folder structure for the site, and reloading the
 * Apache configuration.
 *
 * @author Jon Gamble <jon@trimarksolutions.com>
 * @copyright 2013 Trimark Solutions
 * @license All Rights Reserved
 */

class createHost
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

	public function createUser()
	{
		$output = 'useradd -p '.$this->_userPass.' '.$this->_userName."<br/>";
		//$output = shell_exec('useradd -p'.$_userPass.' '.$_userName);
		return $output;
	}

	public function chooseClientType($var)
	{
		switch ($var) {
			case 'general-client':
				$output = '/trimark/general-clients/domains/';
				break;
			case 'pharmacy':
				$output = '/trimark/pharmacy-webdesign/domains/';
				break;
			case 'trimark':
				$output = '/trimark/trimark-solutions/domains/';
				break;
			case 'window-world':
				$output = '/trimark/window-world/store-sites/domains/';
				break;
			case 'wordpress':
				$output = '/trimark/wordpress/domains/';
				break;
			default:
				$output = '/trimark/general-clients/domains/';
				break;
		}
		return $output;
	}

	public function createFolder()
	{
		$userType = $this->chooseClientType($this->_clientType);
		$output = 'mkdir '.$userType.''.$this->_folderName;
		return $output;
	}

	public function createVirtualHost()
	{
		$input = '# domain: example.com'."\n";
		$input .= '# public: /home/example_user/public/example.com/'."\n\n";

		$input .= '<VirtualHost *:80>'."\n";
  		$input .= '# Admin email, Server Name (domain name), and any aliases'."\n";
  		$input .= 'ServerAdmin webmaster@example.com'."\n";
  		$input .= 'ServerName  www.example.com'."\n";
  		$input .= 'ServerAlias example.com'."\n\n";

  		$input .= '# Index file and Document Root (where the public files are located)'."\n";
  		$input .= 'DirectoryIndex index.html index.php'."\n";
  		$input .= 'DocumentRoot /home/example_user/public/example.com/public'."\n\n";

  		$input .= '# Log file locations'."\n";
  		$input .= 'LogLevel warn'."\n";
  		$input .= 'ErrorLog  /home/example_user/public/example.com/log/error.log'."\n";
  		$input .= 'CustomLog /home/example_user/public/example.com/log/access.log combined'."\n";
		$input .= '</VirtualHost>'."\n";

	}
	

	public function enableSite(){
		$output = 'a2ensite '.$this->_domainName;
		return $output;
	}
	public function restartApache()
	{
		$output = 'service apache2 restart';
		return $output;
	}
}
?>