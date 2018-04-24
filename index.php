<?php
	include 'search.php';		
?>
<html>
	<head>
		<meta content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="cantusstyle.css">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>		
		<script type="text/javascript" src="maphelper.js"></script>	
		<script type="text/javascript" src="search_help.js"></script>	
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
						
						<script>
							document.getElementById("libraries").selectedIndex = -1;
						</script>
					</div>						
				</div>
					
			</div>
			
			
			<div class="grid-item"></div>
			<div class="grid-item-map">
				<div id="map"></div>
			</div>
		
		</div>
		
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnDhlZqdndiNq0tPLxlOgNYMDMXBVZ0Ks&callback=initMap" type="text/javascript"></script>
	
	</body>
	

</html>