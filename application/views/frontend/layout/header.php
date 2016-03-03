<script>
function close_login(){
	document.getElementById("login-form").style.display = "none";
}
function showLogin(){
	$('#login-form').slideDown(200);
}

</script>

<!-- begin header -->
    <header>
        <div id="top">
            <span>Hotline CSKH: <a class="link" href="">0982 191 375</a> | <a class="link" href="frontend/store/index">Hệ thống cửa hàng</a></span>
		<?php
			if(isset($data['user']) && !empty($data['user'])){
				?>
				
				<?php
				echo '<label><p>Xin Chào,<a href="frontend/user/info">'.$data['user']['email'].'</a></p><a href="frontend/user/logout">Thoát</a><label>';
			}
			else if(isset($data['user_face']) && !empty($data['user_face'])){
				//print_r($data['user_face']);
				echo '<label><p>Xin Chào,<a href="frontend/user/info">'.$data['user_face']['name'].'</a></p><a href="frontend/user/logout">Thoát</a><label>';
			}
			else{
		?>
            <ul>
                <li>
					<i class="fa fa-user"></i>
					<a href="javascript:avoid()"  onClick="showLogin();" title="Đăng nhập" >Đăng nhập</a>
				</li>
				
                <li><i class="fa fa-key"></i> <a href="frontend/account/register" title="">Đăng ký</a></li>
            </ul>
		<?php } ?>	
        </div>
		
        <div id="bottom">
            <a title="Trang chủ" href=""><div id="logo"></div></a>
            <a class="link" href="frontend/cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
			<div class="wrap_form_login" id="login-form" style="display: none;">
				<h2 class="title_login">Đăng nhập <i onclick="close_login()" class="fa fa-times close-pop"></i></h2>
				<div class="top_form">


					<div class="login_fb" style="text-align: center;">
						<fb:login-button size="xlarge" data-height="270" scope="public_profile,email" onlogin="checkLoginState();">
							<span style="display:none;">Login Facebook</span>
						</fb:login-button>
					</div>

					<div class="or">
						<span>HOẶC</span>
					</div>
					<form action="frontend/user/login" method="post" id="formLogin">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="txtUsernameLoginForm" name="email" type="text" class="input-text f-mail form-control">
						</div>
						<div class="form-group">
							<label for="password">Mật khẩu</label>
							<input id="txtPasswordLoginForm" name="pass" type="password" class="input-text f-pass form-control">
						</div>
						<div class="text-danger" id="div-login-fail" ></div>
						<div class="form-group row-submit">
							<input type="button" onclick="loadform_login();" class="btn-login" value="Đăng nhập">
							<a href="frontend/user/forgot" class="forget_password">Quên mật khẩu?</a>
						</div>
						<input type="hidden" value="" id="txtActionRedirect">
					</form>
				</div>
				<div class="bottom_form">
					<div class="signup">
						
					</div>
				</div>
			</div>
        </div>

        <!-- begin navigation -->
        <nav>
			
            <?php
				echo frontend_menu(array(
						'article_category' => frontend_menu_getdata('article_category'),
					));
			?>
        </nav>
    </header>
