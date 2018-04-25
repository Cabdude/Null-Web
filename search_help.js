$(document).ready(function(){

	$(function(){
		$('#countries').change(function(){
			
			var selected = $("#countries option:selected").text();
			console.log(selected);

            var manuscripts = $("#manuscriptTable");
            manuscripts.empty();
				
				$.post('search.php', {countryName: selected}, function(data){
					try {	
						var libraries = $("#libraries");
						libraries.empty();
						console.log(data);
						
						var jsonLibs = $.parseJSON(data);
							
						$.each(jsonLibs,function(index,library)
						{
							libraries.append(library);
						});//end iteration
						if(selected == "All")
						{
							highlightWholeMap();
						}
						else
						{
						highlightCountry(selected);	
						}
						document.getElementById("libraries").selectedIndex = -1;
						
					}
					catch(err)
					{
						clearOverlays();
					}
				});//end post	

				
		});//end onchange
	});
	
});

$(document).on('change','#libraries', function() { 
	var country = $("#countries option:selected").text();
	var library = $("#libraries option:selected").text();
    var manuscripts = $("#manuscriptTable");
    manuscripts.empty();



    $.post('search.php', {libraryName: library}, function(data){
        var manuscripts = $("#manuscriptTable");
        manuscripts.empty();
        console.log(data);



        var jsonLibs = $.parseJSON(data);


        $.each(jsonLibs,function(index,manuscript)
        {
            manuscripts.append(manuscript);
        });//end iteration

    });




    geocodeLibraryAddress(geocoder,map,library,country);
	
});




