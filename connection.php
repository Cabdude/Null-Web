<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Manuscript2018";
	$connected = false;

	if(!$connected){
		$mysqli = new mysqli($servername,$username,$password,$dbname);

		if($mysqli->connect_errno) 
		{
			echo "Connection failed: \n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			exit();
		}	
		
		$connected = true;
	}
	function isConnected(){
		global $connected;
			
		return $connected;	
	}

?>
