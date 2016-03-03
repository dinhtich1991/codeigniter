		<section class="it-tabs">
			<h1>Thêm nhóm thành viên</h1>
			<ul>
				<li><a href="backend/user/group" title="Nhóm thành viên">Nhóm thành viên</a></li>
				<li class="active"><a href="backend/user/addgroup" title="Thêm nhóm thành viên">Thêm nhóm thành viên</a></li>
			</ul>
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action="">
				<section class="main-panel main-panel-single">
					<header>Thông tin chung</header>
					<?php echo common_showerror(validation_errors()); ?>
					<section class="block">
						<label class="item">
							<p class="label">Tiêu đề:</p>
							<input type="text" name="data[title]" value="<?php echo isset($_post['title'])?$_post['title']:''; ?>" class="txtText">
						</label>
						<section class="checkbox-radio">
							<p class="label">Trạng thái:</p>
							<section class="group">
								<label>
									<input type="radio" name="radio" value="1" <?php echo isset($_post['allow'])?(($_post['allow'] == 1)?'checked ="checked"':''):''; ?> /><span>Cho phép</span>
								</label>
								<label>
									<input type="radio" name="radio" value="0" <?php echo isset($_post['allow'])?(($_post['allow'] == 0)?'checked ="checked"':''):''; ?> /><span>Không cho phép</span>
								</label>
							</section>
						</section>
						<label class="item">
							<p class="label">Nội dung:</p>
							<textarea name="data[group]" value="<?php echo isset($_post['group'])?$_post['group']:''; ?>" class="txtTextarea" ></textarea>
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
		