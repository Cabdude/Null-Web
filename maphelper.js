
var map;
var geocoder;
var world_geometry;
var map_zoom_original;

var markerArray = [];

function initMap()
{
	geocoder = new google.maps.Geocoder();
	map = new google.maps.Map(document.getElementById('map'), {
	  center: new google.maps.LatLng(30,0),
	  zoom: 3,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	
	map_zoom_original = map.zoom;
	highlightWholeMap();
	
}


function clearOverlays()
{
	world_geometry.setMap(null);
	 for (var i = 0; i < markerArray.length; i++ ) {
		markerArray[i].setMap(null);
	}
	markerArray.length = 0;
}

function geocodeLibraryAddress(geocoder, resultsMap, libraryName, countryName)
{
	clearOverlays();
	var address = libraryName + "," + countryName;
	if(countryName == "All")
		address = libraryName;
	
	console.log("geocoding");
	geocoder.geocode({'address':address},function(results,status) {
		if(status === 'OK') {
			resultsMap.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: resultsMap,
				position: results[0].geometry.location
			});
			markerArray.push(marker);
			map.setZoom(15);
			map.setCenter(marker.getPosition());
			clearHighlights();
		} else{		
			alert("Sorry, could not find library, implementation to allow updates of address coming soon.");
			highlightCountry(countryName);
		}
	});
	
}

function highlightWholeMap()
{
	if(world_geometry != null)
		clearOverlays();
	
	world_geometry = new google.maps.FusionTablesLayer({
	  query: {
		select: 'geometry',
		from: '1ov8ykzakf3WcwMCIBRsZjzRlOAGvJFsDjN_m9VQ'
		
	  },
	  map: map,
	  suppressInfoWindows: true
	});
	
	map.zoom = map_zoom_original;
		
}

function clearHighlights(){
	
}

function highlightCountry(countryName)
{
	clearOverlays();
	if(countryName == "Great Britain")
	{
		countryName = "United Kingdom";
	}else if(countryName == "All"){
		highlightWholeMap();
	}else{
			
		var clause = "'CountryName'="+ "'" + countryName + "'";
		
		world_geometry = new google.maps.FusionTablesLayer({
		  query: {
			select: 'geometry',
			
			from: '1ov8ykzakf3WcwMCIBRsZjzRlOAGvJFsDjN_m9VQ',
			where: clause
		  },
		  map: map,
		  suppressInfoWindows: true
		});
		
		
		geocoder.geocode({'address':countryName},function(results,status) {
			if(status === 'OK') {
			
				map.zoom = map_zoom_original;
				map.setCenter(results[0].geometry.location);
			}
		});
	}
}