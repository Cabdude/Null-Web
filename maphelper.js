
var map;
function initMap()
{
	 highlightWholeMap();
}

function highlightWholeMap()
{
	map = new google.maps.Map(document.getElementById('map'), {
	  center: new google.maps.LatLng(30,0),
	  zoom: 2,
	  mapTypeId: google.maps.MapTypeId.SATELLITE
	});
	
	
	var world_geometry = new google.maps.FusionTablesLayer({
	  query: {
		select: 'geometry',
		from: '1ov8ykzakf3WcwMCIBRsZjzRlOAGvJFsDjN_m9VQ'
		
	  },
	  map: map,
	  suppressInfoWindows: true
	});
}

function highlightNone(){
	map = new google.maps.Map(document.getElementById('map'), {
	  center: new google.maps.LatLng(30,0),
	  zoom: 2,
	  mapTypeId: google.maps.MapTypeId.SATELLITE
	});
}


function highlightCountry(countryName)
{
	if(countryName == "Great Britain")
	{
		countryName = "United Kingdom";
	}
	
	map = new google.maps.Map(document.getElementById('map'), {
	  center: new google.maps.LatLng(30,0),
	  zoom: 2,
	  mapTypeId: google.maps.MapTypeId.SATELLITE
	});
	
	var clause = "'CountryName'="+ "'" + countryName + "'";
	
	var world_geometry = new google.maps.FusionTablesLayer({
	  query: {
		select: 'geometry',
		
		from: '1ov8ykzakf3WcwMCIBRsZjzRlOAGvJFsDjN_m9VQ',
		where: clause
	  },
	  map: map,
	  suppressInfoWindows: true
	});
}