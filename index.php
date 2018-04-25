<?php
	include 'search.php';
    $time = $_SERVER['REQUEST_TIME'];


    $timeout_duration = 1800;


    if (isset($_SESSION['LAST_ACTIVITY']) &&
        ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        session_unset();
        session_destroy();
        session_start();
    }


    $_SESSION['LAST_ACTIVITY'] = $time;
?>
<html lang="en">
	<head>
		<meta content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="cantusstyle.css">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="maphelper.js"></script>	
		<script type="text/javascript" src="search_help.js"></script>

	</head>
		
	<body>
		<h1> Cantus Re-Forged: Manuscript Search </h1>

		
		<div class="grid-container">
		
			<div class="grid-item-input">
				<div class="input-container">
					<div class="input-item" style="font-weight: bold" >Country:</div>
					<div class="input-item">
						<select id="countries">
						<option name="country" selected="selected">All</option>
							<?php loadCountries($countriesData);?>
						</select>
					</div>
					<div class="input-item" style="font-weight: bold">Library:</div>
					<div class="input-item" >
						<select id="libraries">
							<?php loadLibraries($librariesData);?>								
						</select>
						
						<script>
							document.getElementById("libraries").selectedIndex = -1;
						</script>
					</div>						
				</div>
			</div>
			<div class="grid-item-map">
				<div id="map"></div>
			</div>

            <div class="grid-item-ms-table">
                <table id="manuscriptTable"></table>
            </div>
		
		</div>
		
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnDhlZqdndiNq0tPLxlOgNYMDMXBVZ0Ks&callback=initMap" type="text/javascript"></script>
	
	</body>
	

</html>