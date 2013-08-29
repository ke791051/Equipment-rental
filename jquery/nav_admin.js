// JavaScript Document
$(function(){
	$('#device').click(function(){
		$('#device_list').slideDown(100, function(){
			$('#device').addClass('selected');
		});
	});
	$(document).mouseup(function(event){
		if($(event.target).parent('#device_list').length==0)
		{
			$('#device_list').slideUp(100
			,function(){
				$('#device_list').hide();
				$('.selected').removeClass('selected');
			});
		};
	});
});