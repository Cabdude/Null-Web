$(document).ready(function(){
	
	$('#countries').change(function(){
		
		var selected = $("#countries option:selected").text();
		console.log(selected);
			
		
	
		
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
					
					highlightCountry(selected);	
				}
				catch(err)
				{
					highlightNone()
				}
			});//end post
		
		
		
	});//end onchange

});