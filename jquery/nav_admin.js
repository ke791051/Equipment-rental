// JavaScript Document
$(function(){
	$('#device').click(function(){
		$(this).css('background','rgba(255,255,255,0.4)');
		$('#device_list').slideDown(100);
	})
	$(document).mouseup(function(event){
		if($(event.target).parent('#device_list').length==0)
		{
			$('#device_list').slideUp(100
			,function(){
				$('#device_list').hide();
			});
		}
	})
});