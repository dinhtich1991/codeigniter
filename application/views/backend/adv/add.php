		<section class="it-tabs">
			<h1>Thêm quảng cáo</h1>
			<ul>
				<li><a href="backend/adv/index" title="Quảng cáo">Quảng cáo</a></li>
				<li class="active"><a href="backend/adv/add" title="Thêm quảng cáo">Thêm quảng cáo</a></li>
			</ul>
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action="">
				<section class="main-panel">
					<header>Thông tin chung</header>
					<?php echo common_showerror(validation_errors()); ?>
					<section class="block">
						<label class="item">
							<p class="label">Tiêu đề:</p>
							<input type="text" name="data[title]" value="<?php echo isset($_post['title'])?$_post['title']:''; ?>" class="txtText">
						</label>
						<label class="item">
							<p class="label">Vị trí hiển thị:</p>
							<?php echo form_dropdown('data[position]',array(
								'' => '- Chọn vị trí -',
								'Bên phải' => 'Bên phải',
							),common_valuepost(isset($_post['title'])?$_post['title']:''), 'class="cbSelect"'); ?>
						</label>
						<label class="item">
							<p class="label">Nội dung:</p>
							<textarea name="data[content]" class="txtTextarea"><?php echo isset($_post['content'])?$_post['content']:''; ?></textarea>
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
				<aside class="side-panel">
					
					<section class="block">
						<header>Nâng cao</header>
						<section class="container">
							<section class="checkbox-radio">
								<p class="label">Hiển thị:</p>
								<section class="group">
									<label>
										<input type="radio" name="data[publish]" value="1" <?php echo isset($_post['publish'])?(($_post['publish'] == 1)?'checked ="checked"':''):''; ?> /><span>Có</span>
									</label>
									<label>
										<input type="radio" name="data[publish]" value="0" <?php echo isset($_post['publish'])?(($_post['publish'] == 0)?'checked ="checked"':''):''; ?> /><span>Không</span>
									</label>
								</section>
							</section>
						</section>	<!--end container-->							
					</section><!--end block-->
					
					<section class="block">
						<header>Thời gian</header>
						<section class="container">
							<label class="item">
								<p class="label">Thời gian bắt đầu:</p>
								<input type="text" name = "data[time_start]" value="" class="txtText" id="txtTimestart">
							</label>
							<label class="item">
								<p class="label">Thời gian kết thúc:</p>
								<input type="text" name = "data[time_end]" value="" class="txtText" id="txtTimeend">
							</label>
						</section>	<!--end container-->							
					</section><!--end block-->
					
				</aside><!--end side-->
			</form>
		</section> <!--end form-->
		