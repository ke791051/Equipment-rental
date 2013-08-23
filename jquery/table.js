// JavaScript Document
$(document).ready(function() {
    $('table tr:odd').css('background',"#FFF");/*基數行*/
	$('table tr:even').css('background','#FAFAFA');/*偶數行*/
});

$(document).ready(function(e){
	$('table tr').hover(function(){
		$(this).addClass('light');
	},function(){
		$('.light').removeClass('light');
	});
});
