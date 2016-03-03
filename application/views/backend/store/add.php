		<section class="it-tabs">
			<h1>Hệ thống cửa hàng</h1>
			<ul>
				<li><a href="backend/store/index" title="Hệ thống cửa hàng">Hệ thống cửa hàng</a></li>
				<li class="active"><a href="backend/store/add" title="Thêm hệ thống cửa hàng">Thêm hệ thống cửa hàng</a></li>
			</ul>
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action="">
				<section class="main-panel">
					<header>Thông tin chung</header>
					<?php echo common_showerror(validation_errors()); ?>
					<section class="block">
						<label class="item">
							<p class="label">Tên hệ thống store:</p>
							<input type="text" name="data[name]" value="<?php echo isset($_post['name'])?$_post['name']:''; ?>" class="txtText">
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
										<input type="radio" name="data[public]" value="1" <?php echo isset($_post['public'])?(($_post['public'] == 1)?'checked ="checked"':''):''; ?> /><span>Có</span>
									</label>
									<label>
										<input type="radio" name="data[public]" value="0" <?php echo isset($_post['public'])?(($_post['public'] == 0)?'checked ="checked"':''):''; ?> /><span>Không</span>
									</label>
								</section>
							</section>
						</section>	<!--end container-->							
					</section><!--end block-->
					
				</aside><!--end side-->
			</form>
		</section> <!--end form-->
		