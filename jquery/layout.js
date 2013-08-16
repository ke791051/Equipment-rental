$(function(){
	$(document).ready(function(e) {
    });
	$(document).on('click','#login_Add', LoginAdd);
	$(document).on('click','#close', LoginRemove);
})
function LoginAdd(){
	$.ajax({
			url:'templates/Login.php',
			dataType: "html",
			success: function(data){
				/*$('#login_form').show();*/
				$('#login_Add').hide();
				$('#login_form').html(data);
				$('#login_form').slideDown(300, function(){
					$('#close').show();
				});
			}
	});
}
function LoginRemove(){
	$('#login_form').slideUp(300, function(){
		$('#login_Add').slideDown(200);
	})
	$('#login_main').remove();
}