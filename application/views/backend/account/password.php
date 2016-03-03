<section class="it-tabs">
			<h1>Thay đổi thông tin tài khoản</h1>
			<ul>
				<li><a href="backend/account/info" title="Thay đổi thông tin tài khoản">Thông tin</a></li>
				<li class="active"><a href="backend/account/password" title="Thay đổi thông tin mật khẩu">Mật khẩu</a></li>
			</ul>
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action=""> 
				<section class="main-panel main-panel-single">
					<header>Thông tin chung</header>
					<?php echo common_showerror(validation_errors()); ?> 
					<section class="block">
						<label class="item">
							<p class="label">Tên sử dụng:</p>
							<input type="text" value="<?php echo $auth['username']?>" class="txtText" readonly="true" disabled />
						</label>
						<label class="item">
							<p class="label">Mật khẩu cũ:</p>
							<input type="password" name="data[oldpassword]" value="<?php echo isset($_post['oldpassword'])?$_post['oldpassword']:'' ?>" class="txtText">
						</label>
						<label class="item">
							<p class="label">Mật khẩu mới:</p>
							<input type="password" name="data[newpassword]" value="<?php echo isset($_post['oldpassword'])?$_post['oldpassword']:''  ?>" class="txtText">
						</label>
						<label class="item">
							<p class="label">Xác nhận mật khẩu mới:</p>
							<input type="password" name="data[renewpassword]" value="<?php echo isset($_post['oldpassword'])?$_post['oldpassword']:''  ?>" class="txtText">
						</label>
						
						
						<section class="action">
								<p class="label">Thao tác:</p>
								<section class="group">
									<input type="submit" name="change" value="Thay đổi" />
									<input type="reset" value="Làm lại" />
								</section>
						</section>
					</section><!--end block-->
					
				</section> <!--end main-->
				
			</form>
		</section> <!--end form-->