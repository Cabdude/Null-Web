<?php
	include 'load.php';		
?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="cantusstyle.css">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="search_help.js"></script>	
		<script type="text/javascript" src="maphelper.js"></script>	
	</head>
		
	<body>
		<h1> Cantus DB </h1>
		
		
		<div class="grid-container">
		
			<div class="grid-item">				
					
				<div class="input-container">
					<div class="input-item">Country:</div>
					<div class="input-item">
						<select id="countries">
						<option name="country">All</option>
							<?php loadCountries($countriesData);?>
						</select>
					</div>
					<div class="input-item">Library:</div>
					<div class="input-item">
						<select id="libraries">
							<?php loadLibraries($librariesData);?>								
						</select>
					</div>						
				</div>
					
			</div>
			
			
		</div>
	</body>
	

</html>