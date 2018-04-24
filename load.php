<?php

	include 'connection.php';
	//error_reporting(E_ERROR | E_PARSE);
	if($connected)
	{
		
		$countryPost = isset($_POST['countryName']) ? $_POST['countryName'] : "";
		
				
		$countryQuery = "SELECT * FROM Country";
		$result = $mysqli->query($countryQuery);	
		$countriesData = array();
		$countryID = "";
		
		while($row = mysqli_fetch_assoc($result)){
			$countriesData[] = $row;			
		}
		
		if($countryPost != "All"){
			foreach($countriesData as $data)
			{
				if($countryPost != "")
				{
					if($countryPost == utf8_encode($data['countryName']))
					{						
						$countryID = utf8_encode($data['countryID']);
						break;
					}
				}
			}
		}
		
		if($countryID != "" && $countryPost != "All")
		{
			$libQuery = "SELECT * FROM Library WHERE countryID = '$countryID' GROUP BY Library";
		}else{
			$libQuery = "SELECT * FROM Library GROUP BY library";
		}
				
		$result = $mysqli->query($libQuery);
			
		$librariesData = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$librariesData[] = $row;
		}
		
		
		
		
		function loadCountries($countriesData)
		{
			if(!empty($countriesData))
			{
				$i=0;
				foreach($countriesData as $data)
				{
					echo "<option value='country{$i}'>".utf8_encode($data['countryName'])."</option>\n";
					$i++;
				}
				
				unset($data);
			}
		}
		
		
		
		function loadLibraries($librariesData)
		{
			global $countryID;
			global $countryPost;
			
			$jsonObjs = array();
			
			if(!empty($librariesData))
			{
				$i=0;
				foreach ($librariesData as $data)
				{
					if($countryID != "")
					{
						$jsonObj = "<option value='library{$i}'>".utf8_encode($data['library'])."</option>";
						$jsonObjs[] = $jsonObj;
					}else{
						if($countryPost != "All")
						{
							echo "<option value='library{$i}'>".utf8_encode($data['library'])."</option>\n";
						}else{
							$jsonObj = "<option value='library{$i}'>".utf8_encode($data['library'])."</option>\n";
							$jsonObjs[] = $jsonObj;
						}
					}
					$i++;
				}
				unset($data);
				
				if($countryID != "" || $countryPost == "All")
				{
					echo json_encode($jsonObjs);
				}
			}
			
			
		}
				
		if($countryID != "" || $countryPost == "All")
		{
			loadLibraries($librariesData);
		}
		
	}else{
		exit();
	}

?>