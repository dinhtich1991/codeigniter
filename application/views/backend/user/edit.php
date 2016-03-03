		<section class="it-tabs">
			<h1>Sửa thành viên</h1>
			<ul>
				<li><a href="backend/user/index">Thành viên</a></li>
				<li><a href="backend/user/add">Thêm thành viên</a></li>
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
							<input type="text" name="" value="<?php echo $_username; ?>" class="txtText" readonly />
						</label>
						
						<label class="item">
							<p class="label">Email:</p>
							<input type="text" name="data[email]" value="<?php echo common_valuepost(isset($_post['email'])?$_post['email']:''); ?>" class="txtText" />
						</label>
						<label class="item">
							<p class="label">Nhóm thành viên:</p>
							<?php echo form_dropdown('data[groupid]', (isset($_show['groupid'])?$_show['groupid']:NULL),common_valuepost(isset($_post['groupid'])?$_post['groupid']:0), 'class="cbSelect"'); ?>
						</label>
						<label class="item">
							<p class="label">Google Author:</p>
							<input type="text" name="data[google_author]" value="<?php echo common_valuepost(isset($_post['google_author'])?$_post['google_author']:''); ?>" class="txtText" />
						</label>
						<section class="action">
								<p class="label">Thao tác:</p>
								<section class="group">
									<input type="submit" name="edit" value="Sửa đổi" />
									<input type="reset" value="Làm lại" />
								</section>
						</section>
					</section><!--end block-->
					
				</section> <!--end main-->
				
			</form>
		</section> <!--end form-->
		