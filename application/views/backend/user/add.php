		<section class="it-tabs">
			<h1>Thêm thành viên</h1>
			<ul>
				<li><a href="backend/user/index">Thành viên</a></li>
				<li class="active"><a href="backend/user/add">Thêm thành viên</a></li>
			</ul>
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action="">
				<section class="main-panel main-panel-single">
					<header>Thông tin chung</header>
					<?php echo common_showerror(validation_errors()); ?>
					<section class="block">
						<label class="item">
							<p class="label">Tên đăng nhập:</p>
							<input type="text" name="data[Username]" value="<?php echo common_valuepost(isset($post['Username'])?$post['Username']:''); ?>" class="txtText" />
						</label>
						<label class="item">
							<p class="label">Họ và tên:</p>
							<input type="text" name="data[fullname]" value="<?php echo common_valuepost(isset($post['fullname'])?$post['fullname']:''); ?>" class="txtText" />
						</label>
						<label class="item">
							<p class="label">Mật Khẩu:</p>
							<input type="text" name="data[Password]" value="<?php echo common_valuepost(isset($post['Password'])?$post['Password']:''); ?>" class="txtText" />
						</label>
						<label class="item">
							<p class="label">Xác nhận:</p>
							<input type="text" name="data[repassword]" value="<?php echo common_valuepost(isset($post['repassword'])?$post['repassword']:''); ?>" class="txtText" />
						</label>
						<label class="item">
							<p class="label">Email:</p>
							<input type="text" name="data[Email]" value="<?php echo common_valuepost(isset($post['Email'])?$post['Email']:''); ?>" class="txtText" />
						</label>
						<label class="item">
							<p class="label">Nhóm thành viên:</p>
							<?php echo form_dropdown('data[groupid]', (isset($_show['groupid'])?$_show['groupid']:NULL),common_valuepost(isset($_post['groupid'])?$_post['groupid']:0), 'class="cbSelect"'); ?>
						</label>
						
						<section class="action">
								<p class="label">Thao tác:</p>
								<section class="group">
									<input type="submit" name="add" value="Thêm mới" />
									<input type="reset" value="Làm lại" />
								</section>
						</section>
					</section><!--end block-->
					
				</section> <!--end main-->
				
			</form>
		</section> <!--end form-->
		