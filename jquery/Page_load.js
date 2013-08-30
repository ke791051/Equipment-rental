$(function(){
	page_disable();
	$(document).on('click','#page_load > #close',function(){
		history.back();
	});
	$(document).keydown(function(e){
		if(e.keyCode==27)
			history.back();
	});
});

/*function myregisters_load(){
	$.ajax({
		url:'contents/guestlogin.php',
		dataType:'html',
		success: function(data){
			page_disable();
			$('body').html('<div id="page_load"></div>');
			$('#page_load').html(data);
		}
	});
}*/