function loadcity(t){
	var aj = new XMLHttpRequest();
	aj.onreadystatechange = function(){
		if(aj.readyState == 4 && aj.status == 200){
			document.getElementById('show_district').innerHTML=aj.responseText;
		}
	}
	aj.open('GET', 'frontend/account/loadcity?city='+t, true);
	aj.send();
}
$(window).load(function(){
	$('#btn-submit').click(function(){
		if($('#txtUsernameLoginForm').val() == '' || $('#txtPasswordLoginForm').val() == ''){
			$('#div-login-fail').show();
			return false;
		}
		else{
			$.post( $('#formLogin').attr('action'),
					$('#formLogin :input').serializeArray(),
					function(data){
						$('#div-login-fail').html(data);
					});
			
		}
	});
	$('#alertMe').click(function(e){
		var temp1 = $('#change_password_old').val();
		var temp2 = $('#change_password_new').val();
		var temp3 = $('#change_password_renew').val();
		$.post('frontend/user/changepassword',{pass_old: temp1, pass_new: temp2, pass_renew: temp3}, function(data){
				$('#show_error').html(data);
			});
			$('#show_error').show();
			e.preventDefault();
			$('#successAlert').slideDown();
		
   });
	
});
function loadform_login(){
	if($('#txtUsernameLoginForm').val() == '' || $('#txtPasswordLoginForm').val() == ''){
		$('#div-login-fail').html('Xin nhập tài khoản và mật khẩu!');
		return false;
	}
	
	else{
		$.post( $('#formLogin').attr('action'),
			$('#formLogin :input').serializeArray(),
			function(data){
				$('#div-login-fail').html(data);
			});
		
	}
}
function changefullname(){
	var temp = $('#change_fullname').val();
	if($('#change_fullname').val() == ''){
			$('#hide_fullname').show();
			return false;
		}
	else{
		$.post('frontend/user/changefullname',{name: temp}, function(data){
			$('#change_fullname').val(data);
		});
		alert('Sửa thông tin thành công!');
		$('#hide_fullname').hide();
		return false;
	}
}
function changeemail(){
	var temp = $('#change_email').val();
	if($('#change_email').val() == ''){
			$('#hide_email').show();
			return false;
		}
	else{
		$.post('frontend/user/changeemail', {email: temp}, function(data){
			$('#change_email').val(data);
		});
		alert('Sửa thông tin thành công!');
		$('#hide_email').hide();
		return false;
	}
}
function changesex(){
	var temp = $('input[name=change_sex]:checked').val();
	$.post('frontend/user/changesex', {sex: temp}, function(data){
		$('input[name=change_sex]:checked').val(data);
	});
	alert('Sửa thông tin thành công!');
	return false;
	
}
function changebirth(){
	var temp = $('#change_birth').val();
	if($('#change_birth').val() == ''){
			$('#hide_birth').show();
			return false;
		}
	else{
		$.post('frontend/user/changebirth', {birth: temp}, function(data){
			$('#change_birth').val(data);
		});
		alert('Sửa ngày sinh thành công!');
		$('#hide_birth').hide();
		return false;
	}
}