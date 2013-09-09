/*-----------------------------欄位驗證------------------------------*/
$(function(){
	$(document).on('blur','.null_validate',null_validate);
	$(document).on('blur','.tel_validate',tel_validate);
	$(document).on('click','#submit',valiStatus);
});

function Email_validate(email){
	var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
	
	if(emailRule.test(mail))
		return true;
	else
		return false;
}

function Length_validate(data,length){
	if(data.length >= length)
		return true;
	else
		return false;
}
function Phone_valitest(data){
	var phoneRule = /^[0][1-9]{1,3}[-][0-9]{6,8}$|^(0)(9)([0-9]{2}[-][0-9]{3}[-][0-9]{3})$|^(0)(9)([0-9]{8})$/;
	if(phoneRule.test(data))
		return true;
	else
		return false;
}
function tel_validate(){
	var data=$(this).val();
	if(data == "")
	{
		$(this).addClass('validateWarning');
		$('td > label#info').addClass('vali_info');
		$(this).parent().parent().find('td > label.vali_info').text(' * 欄位不得為空');
	}
	else
	{
		if(!Phone_valitest(data))
		{
			$(this).addClass('validateWarning');
			$('td > label#info').addClass('vali_info_tel');
			$(this).parent().parent().find('td > label.vali_info_tel').text(' * 電話號碼不合法');
		}	
		else
		{
			$(this).removeClass('validateWarning');
			$('#info').removeClass('vali_info_tel');
			$('#info').text("(例:04-22195999或0928-xxxxxx)");
		}
	}
}
function null_validate(){
	var data=$(this).val();
	if(data == "")
	{
		$(this).addClass('validateWarning');
		$(this).parent().parent().find('td > label.vali_info').text(' * 欄位不得為空');
	}
	else
	{
		$(this).removeClass('validateWarning');
		$(this).parent().parent().find('td > label.vali_info').text("");
	}
}
function null_validate_all($this){
	var data=$this.val();
	if(data == "")
	{
		$this.addClass('validateWarning');
		$this.parent().parent().find('td > label.vali_info').text(' * 欄位不得為空');
	}
	else
	{
		$this.removeClass('validateWarning');
		$this.parent().parent().find('td > label.vali_info').text("");
	}
}
function valiStatus(){
	$('input[type="text"]').each(function(){
		null_validate_all($(this));
	});
	if($('.validateWarning').length||$('.vali_info_tel').length)
	{
		alert('資料尚未填妥，請檢察！');
		return false;
	}
}