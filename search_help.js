$(document).ready(function(){
	
	$('#countries').change(function(){
		
		var selected = $("#countries option:selected").text();
		console.log(selected);
			
		
			
			
		$.post('load.php', {countryName: selected}, function(data){
			
			var libraries = $("#libraries");
			libraries.empty();
			console.log(data);
			
			var jsonLibs = $.parseJSON(data);
				
			$.each(jsonLibs,function(index,library)
			{
				libraries.append(library);
			});//end iteration
			
		});//end post
		
	});//end onchange

});