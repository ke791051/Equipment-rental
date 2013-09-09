$(function(){
	$(document).ready(function(e) {
		var request = new XMLHttpRequest();
		request.open('GET', 'get_loginstatus.php', true);
		request.onload = loadLoginStatus;
		request.send();
    });
	$('h2').each(function(){
		textlength($(this));
	});
	$(document).on('click','#login_Add', LoginAdd);
	$(document).on('click','#close', LoginRemove);
	$(document).on('click','h2', textlength);
});
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
	});
	$('#login_main').remove();
};

function loadLoginStatus() {
	var loginStatus = JSON.parse(this.responseText);
	
	var loginInfo = document.getElementById('logininfo');
	if (loginStatus.isLogin) {
		$('#login_Add').hide();
		loginInfo.innerHTML = '歡迎！' + loginStatus.userName;
	} else {
		loginInfo.innerHTML = '歡迎使用本系統！';
	}
}
/*-----------------------------頁面遮罩------------------------------*/
function page_disable(){
	$('#mask').addClass('mask_unfold');
	$('body').css('overflow','hidden');
}
function page_able(){
	$('.mask_unfold').removeClass('mask_unfold');
	$('body').css('overflow','auto');
}
/*-----------------------------資料長度------------------------------*/
function textlength($this){
	var max=60;
	var val=$this.text();
	if(val.length > max)
	{
		$this.text(val.substr(0,(max-1)) + '...');
	}
}